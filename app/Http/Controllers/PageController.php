<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;

class PageController extends Controller
{

    public function home(): View
    {
        return view('pages.home');
    }

    public function division(string $division): View {
        $data = config("divisions.{$division}");

        abort_unless($data, 404);

        return view("pages.{$division}", [
            'slug' => $division,
            'division' => $data,
        ]);
    }

    public function sitemap(): Response {
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
