$(document).ready(function() {
    // Fonction pour filtrer les éléments
    function filterElements() {
      var brand = $('#filter-brand').val();
      var energy = $('#filter-energy').val();
      var yearMin = parseInt($('#filter-year-min').val(), 10);
      var yearMax = parseInt($('#filter-year-max').val(), 10);
      var kmMin = parseInt($('#filter-km-min').val(), 10);
      var kmMax = parseInt($('#filter-km-max').val(), 10);
      var priceMin = parseInt($('#filter-price-min').val(), 10);
      var priceMax = parseInt($('#filter-price-max').val(), 10);
  
      $('.post-element').each(function() {
        var el = $(this);
        var elBrand = el.data('brand');
        var elEnergy = el.data('energy');
        var elYear = parseInt(el.data('year'), 10);
        var elKm = parseInt(el.data('kilometer'), 10);
        var elPrice = parseInt(el.data('price'), 10);
  
        if ((brand === '' || elBrand === brand) &&
            (energy === '' || elEnergy === energy) &&
            (elYear >= yearMin && elYear <= yearMax) &&
            (elKm >= kmMin && elKm <= kmMax) &&
            (elPrice >= priceMin && elPrice <= priceMax)) {
          el.show();
        } else {
          el.hide();
        }
      });
    }
  
    // Écouteurs d'événements pour les champs de filtre
    $('#filter-brand, #filter-energy, #filter-year-min, #filter-year-max, #filter-km-min, #filter-km-max, #filter-price-min, #filter-price-max').on('change', filterElements);
  
    // Initialise le filtrage au chargement
    filterElements();
  });

  
function resetFilters() {
  $('#filter-brand').val('');
  $('#filter-energy').val('');
  $('#filter-year-min').val('1980');
  $('#filter-year-max').val('2024');
  $('#filter-km-min').val('0');
  $('#filter-km-max').val('300000');
  $('#filter-price-min').val('0');
  $('#filter-price-max').val('100000');
  $('.post-element').show(); // Affiche tous les éléments
  filterElements(); // Applique le filtrage pour réinitialiser l'affichage
}

// Écouteur d'événement pour le bouton de réinitialisation
$('#reset-filters').on('click', resetFilters);