import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])


if (document.readyState === "loading" || document.readyState === "interactive") {
    console.log('caricamento')

    document.getElementById('app').style.display = 'block';


    window.addEventListener('load', function () {
        console.log('fine caricamento')

        console.log(document.getElementById('app'));
        document.getElementById('app').style.display = 'block';

        document.getElementById('loading').style.display = 'none';
    });

} else {
    console.log('fine caricamento')

    document.getElementById('app').style.display = 'block';
    document.getElementById('loading').style.display = 'none';
}

const tomtomEl = document.getElementById('tom_tom');
const lngpos = tomtomEl.dataset.longitude;
const latpos = tomtomEl.dataset.latitude;
const API_KEY = 'k41eUXpkTG7gxEctBAJDidKJ6MYAEIwd';
const APPLICATION_NAME = 'TravelBoo';
const APPLICATION_VERSION = '1.0';

tt.setProductInfo(APPLICATION_NAME, APPLICATION_VERSION);
const Address = { lng: lngpos, lat: latpos };

var map = tt.map({
    key: API_KEY,
    container: 'tom_tom',
    center: Address,
    zoom: 13,


});

var marker = new tt.Marker().setLngLat([lngpos, latpos]).addTo(map)


map.addControl(new tt.FullscreenControl());
map.addControl(new tt.NavigationControl());

var popup = null;
var hoveredFeature = null;
map.on('load', function () {
    bindMapEvents();
});
function bindMapEvents() {
    map.on('click', function (event) {
        var feature = map.queryRenderedFeatures(event.point)[0];
        hidePoiMarker();
        if (feature.sourceLayer === 'Point of Interest') {
            map.addLayer({
                'id': 'selectedPoi',
                'source': {
                    'type': 'geojson',
                    'data': {
                        'type': 'Feature',
                        'geometry': {
                            'type': 'Point',
                            'coordinates': feature.geometry.coordinates
                        }
                    }
                },
                'type': 'symbol',
                'paint': {
                    'text-color': 'rgba(0, 0, 0, 1)',
                    'text-halo-color': 'rgba(255, 255, 255, 1)',
                    'text-halo-width': 1
                },
                'layout': {
                    'text-field': feature.properties.name || feature.properties.description,
                    'icon-image': `${feature.properties.icon}_pin`,
                    'icon-anchor': 'bottom',
                    'text-letter-spacing': 0.1,
                    'icon-padding': 5,
                    'icon-offset': [0, 5],
                    'text-max-width': 10,
                    'text-variable-anchor': ['top'],
                    'text-font': ['Noto-Bold'],
                    'text-size': 14,
                    'text-radial-offset': 0.2
                }
            });
        }
    });
    map.on('mouseenter', 'POI', function (event) {
        map.getCanvas().style.cursor = 'pointer';
        var feature = map.queryRenderedFeatures(event.point)[0];
        createPopup(feature);
        hoveredFeature = feature;
        map.setFeatureState(feature, { hover: true });
    });
    map.on('mouseleave', 'POI', function (event) {
        map.getCanvas().style.cursor = '';
        if (hoveredFeature) {
            map.setFeatureState(hoveredFeature, { hover: false });
        }
        hoveredFeature = null;
        if (!event.originalEvent.relatedTarget) {
            removePopup();
        }
    });
    map.on('click', 'POI', function (event) {
        map.getCanvas().style.cursor = '';
        if (hoveredFeature) {
            map.setFeatureState(hoveredFeature, { hover: false });
        }
        hoveredFeature = null;
        if (!event.originalEvent.relatedTarget) {
            removePopup();
        }
    });
}
function createPopup(result) {
    var markerSize = 10;
    removePopup();
    var popupOffset = {
        'top': [0, markerSize],
        'top-left': [0, markerSize],
        'top-right': [0, markerSize],
        'bottom': [0, -markerSize],
        'bottom-left': [0, -markerSize],
        'bottom-right': [0, -markerSize],
        'left': [markerSize, -markerSize],
        'right': [-markerSize, -markerSize]
    };
    var htmlContent = document.createElement('div');
    htmlContent.innerHTML = '<div class="popup-container">' +
        '<div class="category">' +
        Formatters.formatCategoryName(result.properties.category) +
        '</div>' +
        '<div class="name">' + result.properties.name + '</div>' +
        '</div>';
    popup = new tt.Popup({ offset: popupOffset })
        .setLngLat(result.geometry.coordinates)
        .setDOMContent(htmlContent)
        .addTo(map)
        .setMaxWidth('200px');
    htmlContent.addEventListener('mouseleave', function () {
        removePopup();
    });
}
function removePopup() {
    if (popup) {
        popup.remove();
        popup = null;
    }
}
function hidePoiMarker() {
    if (map.getLayer('selectedPoi')) {
        map.removeLayer('selectedPoi');
        map.removeSource('selectedPoi');
    }
}

function isMobileOrTablet() { var i, a = !1; return i = navigator.userAgent || navigator.vendor || window.opera, (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(i) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(i.substr(0, 4))) && (a = !0), a } window.isMobileOrTablet = window.isMobileOrTablet || isMobileOrTablet;

function convertToPoint(t) { return { point: { latitude: t.lat, longitude: t.lng } } } function convertToSpeedFormat(t, r) { return t + (r || "km/h") } function formatToDurationTimeString(t) { var r = moment.utc(1e3 * t); if (t > 86400) { var o = function (t) { return { days: Math.floor(t / 86400), rest: t % 86400 } }(t); return o.days + (1 === o.days ? " day " : " days ") + moment.utc(1e3 * o.rest).format("h [h] m [m]") } return t > 3600 ? r.format("H [h] m [m] s [s]") : t > 60 ? r.format("m [m] s [s]") : t > 0 ? r.format("s [s]") : "No delay" } function formatToShortDurationTimeString(t) { var r = moment.duration(t, "seconds"); return t > 3600 ? r.format("h [h] m [m]") : t > 60 ? r.format("m [m]") : "No delay" } function formatToTimeString(t) { return moment(t).format("HH:mm:ss") } function formatToDateString(t) { return moment(t).format("DD/MM/YYYY") } function formatToShortenedTimeString(t) { return moment(t).format("h:mm a") } function dateTimeStringToObject(t, r) { if (!t.match(/^(\d{2})\/(\d{2})\/(\d{4})$/)) throw new TypeError("Wrong date format provided. It needs to follow dd/mm/yyyy pattern."); return moment(t + r, "DD/MM/YYYYh:mm A").toDate() } function dateStringToObject(t) { return moment(t, "YYYY-MM-DD").toDate() } function formatToDateWithFullMonth(t) { return moment(t).format("MMMM D, YYYY") } function formatToExpandedDateTimeString(t) { return moment(t).format("dddd, MMM D, HH:mm:ss") } function formatToDateTimeString(t) { return moment(t).format("MMM D, HH:mm:ss") } function formatToDateTimeStringForTrafficIncidents(t) { return moment(t).format("YYYY-MM-DD HH:mm") } function formatAsImperialDistance(t) { var r = Math.round(1.094 * t); return r >= 1760 ? Math.round(r / 17.6) / 100 + " mi" : r + " yd" } function formatAsMetricDistance(t) { var r = Math.round(t); return r >= 1e3 ? Math.round(r / 100) / 10 + " km" : r + " m" } function roundLatLng(t) { return Math.round(1e6 * t) / 1e6 } function formatCategoryName(t) { var r = t.toLowerCase().replace(/_/g, " "); return r.charAt(0).toUpperCase() + r.slice(1) } var Formatters = { convertToPoint: convertToPoint, convertToSpeedFormat: convertToSpeedFormat, formatToDurationTimeString: formatToDurationTimeString, formatToShortDurationTimeString: formatToShortDurationTimeString, formatToTimeString: formatToTimeString, formatToExpandedDateTimeString: formatToExpandedDateTimeString, formatAsImperialDistance: formatAsImperialDistance, formatAsMetricDistance: formatAsMetricDistance, roundLatLng: roundLatLng, formatToDateString: formatToDateString, formatToShortenedTimeString: formatToShortenedTimeString, dateTimeStringToObject: dateTimeStringToObject, dateStringToObject: dateStringToObject, formatToDateWithFullMonth: formatToDateWithFullMonth, formatCategoryName: formatCategoryName, formatToDateTimeString: formatToDateTimeString, formatToDateTimeStringForTrafficIncidents: formatToDateTimeStringForTrafficIncidents }; window.Formatters = window.Formatters || Formatters;