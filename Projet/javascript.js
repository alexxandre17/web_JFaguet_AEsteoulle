/* let mon_nombre = Math.floor(Math.random()*100);
console.log(mon_nombre);
let msg = prompt('Nombre auquel vous pensez');
let tps_strat = Date.now()
while (msg != mon_nombre){
    if (msg < mon_nombre) {
        msg = prompt('le nombre est plus grand');
    }
   else if (msg > mon_nombre) {
        msg = prompt('le nombre est plus petit');
    }
}
let tps = Math.floor((Date.now() - tps_strat)*0.001);

alert('vous avez gagné, vous avez mis '+tps+' secondes pour trouver la solution');
*/

function around (nombre) {
    return Number(Number(nombre).toFixed(5));
}

function inverse_tab (tab){
    return tab.reverse();
}

function supression_born(point) {
     if (point[1] > 48.84  &&
           point[1] < 48.86 &&
           point[0] >2.33 &&
           point[0] < 2.37){
           return point}
    else{
    return []}
}
let coords = [[[[48.857757564566924,2.339316137485028],[48.856806083163775,2.3410084512700275],[48.85500429223433,2.3431007664951173],[48.85424556800601,2.3448607983431384],[48.85346104822773,2.3470146522513193],[48.852722069967,2.348637735017842],[48.852246283670866,2.3498685086796596],[5.513516521235,3.512416589454425],[48.85158827389591,2.352683903431068],[48.85202863524094,2.352391594686386],[48.85372424333016,2.3520685166001587],[48.8546352926156,2.3512762060553634],[48.85546534530812,2.3495454305934325],[48.855769019683805,2.3483223492670007],[48.85667497062573,2.3452915691247744],[48.857282302859346,2.3412992470592533],[48.857757564566924,2.339316137485028]]],[[[48.85374747782521,2.3530207906753438],[48.85253332128681,2.3532408660072544],[48.85163103910017,2.353884163131301],[48.85105178764471,2.3558479122468126],[48.849893264629145,2.3592336865839],[48.84948109132219,2.360317134371768],[48.85032771390132,2.36001241468143],[48.85104064812796,2.3601478456549136],[48.85167559662685,2.35960612176098],[48.85373633890825,2.353410154724109],[48.85374747782521,2.3530207906753438]]]]
;

let newpolygons = coords.map(polygon =>
    polygon.map(shape =>
        shape.map(point => [around(point[0]), around(point[1])]).map(point => 
            inverse_tab(point)).map(point => 
            supression_born(point))
    )
);
console.log(newpolygons)
/*let reversedCoords = newpolygons.map(polygon =>
    polygon.map(shape =>
        shape.map(point => inverse_tab(point))
    )
);
console.log(reversedCoords)
let polygons = reversedCoords.map(polygon =>
    polygon.map(shape =>
        shape.map(point => supression_born(point)))
);  

console.log(polygons)*/