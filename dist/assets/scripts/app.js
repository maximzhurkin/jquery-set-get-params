$(document).ready(function() {
  $('.categories__link').click(function() {
    var id;
    id = $(this).data('id');
    $().setGetParams({
      'search': '',
      'page': 1,
      'category': id
    });
  });
  $('input[name=search]').keyup(function(e) {
    var query;
    query = $(this).val();
    if (e.keyCode === 13) {
      if (query.length) {
        $().setGetParams({
          'search': query,
          'page': 1
        });
      }
    }
  });
  $('select[name=sort]').change(function() {
    var sort;
    sort = $(this).val();
    $().setGetParams({
      'page': 1,
      'sort': sort
    });
  });
  $('select[name=count]').change(function() {
    var count;
    count = $(this).val();
    $().setGetParams({
      'page': 1,
      'count': count
    });
  });
  $('.pagination__link').click(function() {
    var page;
    page = $(this).data('page');
    $().setGetParams({
      'page': page
    });
  });
});
