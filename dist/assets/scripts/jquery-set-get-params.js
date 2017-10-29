(function($) {
  var methods;
  methods = {
    set: function(params) {
      var base, query, result, url;
      url = location.href.split('#')[0].split('?');
      base = url[0];
      query = url[1];
      result = query;
      $.each(params, function(argumentKey, argumentValue) {
        result = methods.build(argumentKey, argumentValue, result);
      });
      window.location.href = base + '?' + result;
      return false;
    },
    build: function(argumentKey, argumentValue, query) {
      var i, keyValue, params, result;
      result = '';
      if (query) {
        params = query.split('&');
        i = 0;
        while (i < params.length) {
          keyValue = params[i].split('=');
          if (keyValue[0] !== argumentKey) {
            result += params[i] + '&';
          }
          i++;
        }
      }
      result += argumentKey + '=' + argumentValue;
      return result;
    }
  };
  jQuery.fn.setGetParams = function(params) {
    methods.set(params);
  };
})(jQuery);
