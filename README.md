# jQuery setGetParams Plugin
Add and change GET parameters in address bar

[DEMO](http://set-get-param.maxzhurkin.name)

## Getting Started
1. Include jQuery and setGetParams
```html
<script src="jquery.min.js"></script>
<script src="jquery-set-get-params.min.js"></script>
```
2. Bind plugin on event
```html
<script>
	$(el).click(function() {
		$().setGetParams({
			'param1': value1,
			'param2': value2
		});
	});
</script>
```
