MAPA LOGISTICO - VERSION MARKETING

Abre index.html en Chrome/Edge.
El archivo mexico.geojson contiene los limites estatales para que NO tengas que capturar coordenadas de los estados.

Para cambiar los estados donde aparece la empresa:
Edita el objeto `operations` en app.js. Solo necesitas poner el nombre del estado y el texto; las coordenadas de los hubs se incluyen internamente para la visualizacion.

Para cambiar las conexiones:
Edita `routes`. Usa:
terrestre = camion
maritima = barco
aerea = avion

La base cartografica usa CARTO/OpenStreetMap y Leaflet. El GeoJSON de estados se integra localmente para que el proyecto pueda abrirse sin descargar el archivo de estados en cada carga.
