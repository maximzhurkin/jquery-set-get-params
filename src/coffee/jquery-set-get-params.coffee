(($) ->
	methods =
		set: (params) ->
			url = location.href.split('#')[0].split('?')
			base = url[0]
			query = url[1]
			result = query

			$.each params, (argumentKey, argumentValue) ->
				result = methods.build(argumentKey, argumentValue, result)
				return

			window.location.href = base + '?' + result
			return false

		build: (argumentKey, argumentValue, query) ->
			result = ''

			if query
				params = query.split('&')
				i = 0
				while i < params.length
					keyValue = params[i].split('=')
					if keyValue[0] != argumentKey
						result += params[i] + '&'
					i++
			result += argumentKey + '=' + argumentValue
			return result

	jQuery.fn.setGetParams = (params) ->
		methods.set params
		return

	return
) jQuery
