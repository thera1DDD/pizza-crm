<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="swagger-ui.css" />
    <title>Swagger UI</title>
</head>
<body>
<div id="swagger-ui"></div>
<script src="swagger-ui-bundle.js"></script>
<script src="swagger-ui-standalone-preset.js"></script>
<script>
    const ui = SwaggerUIBundle({
        url: "/api-docs",
        dom_id: '#swagger-ui',
        presets: [
            SwaggerUIBundle.presets.apis,
            SwaggerUIStandalonePreset
        ],
        layout: "StandaloneLayout"
    });
</script>
</body>
</html>
