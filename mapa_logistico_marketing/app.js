const map=L.map("map",{zoomControl:false,attributionControl:true,scrollWheelZoom:true}).setView([25.2,-108.8],5.25);
L.control.zoom({position:"bottomright"}).addTo(map);
L.tileLayer("https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png",{maxZoom:19,attribution:"&copy; OpenStreetMap &copy; CARTO"}).addTo(map);
setTimeout(()=>map.invalidateSize(),300);

const operations={
  "Puerto del Pacífico":{type:"port",text:"Punto de llegada marítima del Pacífico.",center:[32.0,-120.5]},
  "Tijuana":{type:"port",text:"Centro de distribución del Pacífico.",center:[32.5,-117.0]},
  "Monterrey":{type:"hub",text:"Hub estratégico del noreste.",center:[25.7,-100.3]},
  "Guadalajara":{type:"hub",text:"Centro logístico del occidente.",center:[20.7,-103.4]},
  "Querétaro":{type:"hub",text:"Nodo central convergente nacional.",center:[20.6,-100.4]},
  "Puerto de Manzanillo":{type:"port",text:"Punto de llegada marítima de Manzanillo.",center:[18.8,-109.5]},
  "Manzanillo":{type:"port",text:"Centro de distribución del Pacífico central.",center:[19.0,-104.3]},
  "Puerto del Golfo":{type:"port",text:"Punto de llegada marítima del Golfo de México.",center:[18.5,-84.5]},
  "Tabasco":{type:"port",text:"Centro de distribución del Golfo.",center:[17.9,-92.6]},
  "Estado de México":{type:"hub",text:"Centro de distribución final metropolitano.",center:[19.5,-99.5]}
};

const routes=[
  {from:"Puerto del Pacífico",to:"Tijuana",type:"maritima",vehicle:"🚢"},
  {from:"Tijuana",to:"Querétaro",type:"terrestre",vehicle:"🚚"},
  {from:"Puerto de Manzanillo",to:"Manzanillo",type:"maritima",vehicle:"🚢"},
  {from:"Manzanillo",to:"Querétaro",type:"terrestre",vehicle:"🚚"},
  {from:"Monterrey",to:"Querétaro",type:"terrestre",vehicle:"🚚"},
  {from:"Guadalajara",to:"Querétaro",type:"terrestre",vehicle:"🚚"},
  {from:"Puerto del Golfo",to:"Tabasco",type:"maritima",vehicle:"🚢"},
  {from:"Tabasco",to:"Querétaro",type:"terrestre",vehicle:"🚚"},
  {from:"Querétaro",to:"Estado de México",type:"terrestre",vehicle:"🚚"},
  {from:"Estado de México",to:"Monterrey",type:"terrestre",vehicle:"🚚"},
  {from:"Estado de México",to:"Tijuana",type:"terrestre",vehicle:"🚚"}
];

const colors={terrestre:"#55d9ff",maritima:"#4de2a0"};
const active=new Set(Object.keys(operations));
let geoLayer, routeLayer=L.layerGroup().addTo(map), hubLayer=L.layerGroup().addTo(map), moving=L.layerGroup().addTo(map);
let stateFeatures={};

function stateName(p){
  return p.name||p.NOMGEO||p.NOM_ENT||p.NAME_1||p.estado||p.Estado||"Estado";
}
function styleState(feature){
  const name=stateName(feature.properties||{});
  const activeState=active.has(name);
  return {color:activeState?"#4e92aa":"#203746",weight:activeState?1.2:.6,fillColor:activeState?"#0d4051":"#0b1a25",fillOpacity:activeState?.78:.62};
}
function onEach(feature,layer){
  const name=stateName(feature.properties||{});
  stateFeatures[name]=layer;
  layer.bindTooltip(name,{sticky:true,className:"state-label"});
  layer.on({
    mouseover:()=>layer.setStyle({fillColor:active.has(name)?"#17627a":"#102734",weight:1.5}),
    mouseout:()=>geoLayer.resetStyle(layer),
    click:()=>showState(name)
  });
}
fetch("mexico.geojson").then(r=>r.json()).then(data=>{
  geoLayer=L.geoJSON(data,{style:styleState,onEachFeature:onEach}).addTo(map);
  map.fitBounds(geoLayer.getBounds(),{padding:[30,30]});
  addHubs(); drawRoutes();
}).catch(()=>{ addHubs(); drawRoutes(); });

function markerIcon(type){
  return L.divIcon({className:"",html:`<div class="${type==="port"?"port-dot":"hub-dot"} pulse"></div>`,iconSize:[11,11],iconAnchor:[5.5,5.5]});
}
function addHubs(){
  hubLayer.clearLayers();
  Object.entries(operations).forEach(([name,d])=>{
    const m=L.marker(d.center,{icon:markerIcon(d.type)})
      .bindTooltip(name,{direction:"top",offset:[0,-7],className:"state-label"})
      .on("click",()=>showState(name));
    hubLayer.addLayer(m);
  });
}
function coords(name){return operations[name].center}
function curve(a,b,type){
  const [lat1,lng1]=a,[lat2,lng2]=b,dx=lng2-lng1,dy=lat2-lat1,d=Math.hypot(dx,dy);
  const bend=(type==="maritima"?.12:type==="aerea"?.08:.045)*d;
  const c=[(lat1+lat2)/2+(dx/d)*bend,(lng1+lng2)/2-(dy/d)*bend];
  const pts=[];
  for(let i=0;i<=55;i++){let t=i/55,u=1-t;pts.push([u*u*lat1+2*u*t*c[0]+t*t*lat2,u*u*lng1+2*u*t*c[1]+t*t*lng2])}
  return pts;
}
function drawRoutes(){
  routeLayer.clearLayers();
  routes.forEach(r=>{
    if(!active.has(r.from)||!active.has(r.to))return;
    const pts=curve(coords(r.from),coords(r.to),r.type),c=colors[r.type];
    L.polyline(pts,{color:"#000",weight:7,opacity:.35}).addTo(routeLayer);
    L.polyline(pts,{color:c,weight:2,opacity:.9,dashArray:r.type==="maritima"?"6 8":r.type==="aerea"?"3 8":null}).bindTooltip(`${r.from} → ${r.to}`,{sticky:true}).addTo(routeLayer);
  });
}
function interp(pts,t){
  const ct=Math.min(1,Math.max(0,t));
  const p=(pts.length-1)*ct,i=Math.floor(p),f=p-i,a=pts[i],b=pts[Math.min(i+1,pts.length-1)];
  return [a[0]+(b[0]-a[0])*f,a[1]+(b[1]-a[1])*f];
}
function animate(r,delay){
  setTimeout(()=>{
    const pts=curve(coords(r.from),coords(r.to),r.type);
    const icon=L.divIcon({className:"",html:`<div class="moving">${r.vehicle}</div>`,iconSize:[25,25],iconAnchor:[12,12]});
    const m=L.marker(pts[0],{icon}).addTo(moving);
    const start=performance.now(),duration=2200+Math.random()*900;
    function tick(now){const t=Math.min(1,(now-start)/duration);m.setLatLng(interp(pts,t));if(t<1)requestAnimationFrame(tick);else setTimeout(()=>moving.removeLayer(m),500)}
    requestAnimationFrame(tick);
  },delay);
}
function play(){
  moving.clearLayers();
  routes.forEach((r,i)=>animate(r,i*420));
  toast("Red logística en movimiento");
  const totalDuration=routes.length*420+3100+500;
  setTimeout(()=>location.reload(),totalDuration);
}
function showState(name){
  const data=operations[name];
  if(!data)return;
  document.getElementById("selectedTitle").textContent=name;
  document.getElementById("selectedText").textContent="";
  const related=routes.filter(r=>r.from===name||r.to===name);
  document.getElementById("routeList").innerHTML=related.length?related.map(r=>`<div class="route-item"><b>${r.vehicle} ${r.from} → ${r.to}</b><span>${r.type.toUpperCase()}</span></div>`).join(""):"<div class='route-item'>Sin conexiones configuradas.</div>";
  document.querySelector(".side-panel").classList.add("open");
  map.flyTo(data.center,7,{duration:1});
  toast(`Conexión: ${name}`);
}
function toast(text){
  const el=document.getElementById("toast");el.textContent=text;el.classList.add("show");clearTimeout(window.toastT);window.toastT=setTimeout(()=>el.classList.remove("show"),1800);
}
document.getElementById("closePanel").onclick=()=>document.querySelector(".side-panel").classList.remove("open");
setTimeout(play,1200);
