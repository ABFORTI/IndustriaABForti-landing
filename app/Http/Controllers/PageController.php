<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Home: resume el recorrido narrativo completo del grupo
     * (BRIEF §4-7, §11-13). Las secciones leen config('divisions') y
     * config('locations') por sí mismas (son reutilizables fuera del Home),
     * así que no hace falta pasarles datos desde aquí.
     */
    public function home(): View
    {
        return view('pages.home');
    }

    /**
     * Página propia de cada división: /industria, /logistica, /inmobiliaria
     * (BRIEF §8-10, §20 — URLs amigables e indexables por división).
     *
     * La vista tiene el mismo nombre que el slug (restringido en las rutas
     * a las claves de config/divisions.php, ver routes/web.php), así que
     * cada división puede tener secciones propias (BRIEF §8, §9 y §10 no
     * comparten estructura) sin condicionales dentro de una vista genérica.
     */
    public function division(string $division): View
    {
        $data = config("divisions.{$division}");

        abort_unless($data, 404);

        return view("pages.{$division}", [
            'slug' => $division,
            'division' => $data,
        ]);
    }

    /**
     * sitemap.xml (BRIEF §20 — "URLs amigables"): las 4 páginas reales del
     * sitio, generadas desde config/divisions.php para no duplicar la lista
     * de rutas a mano.
     *
     * Se construye con SimpleXMLElement en vez de una vista Blade: un
     * prólogo "<?xml ...?>" al inicio de un .blade.php confunde a los
     * linters de PHP (lo interpretan como una apertura de PHP real, aunque
     * Blade lo compile bien) — más simple evitar Blade aquí que pelear con
     * el linter.
     */
    public function sitemap(): Response
    {
        $urls = collect([route('home')])
            ->merge(collect(array_keys(config('divisions')))->map(
                fn (string $slug) => route('divisions.show', $slug)
            ));

        $xml = new \SimpleXMLElement(
            '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>'
        );

        foreach ($urls as $url) {
            $xml->addChild('url')->addChild('loc', htmlspecialchars($url, ENT_XML1));
        }

        return response($xml->asXML())->header('Content-Type', 'application/xml');
    }
}
