<?php /*a:1:{s:75:"/www/wwwroot/www.hyperionrobot.com/public/plugins/swagger/view/swagger.html";i:1727661958;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ThinkCMF API documentation</title>
    <link rel="stylesheet" type="text/css" href="/plugins/swagger/view/public/assets/swagger/swagger-ui.css">
    <link rel="icon" type="image/png" href="/plugins/swagger/view/public/assets/swagger/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="/plugins/swagger/view/public/assets/swagger/favicon-16x16.png" sizes="16x16"/>
    <style>
        html {
            box-sizing: border-box;
            overflow: -moz-scrollbars-vertical;
            overflow-y: scroll;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        body {
            margin: 0;
            background: #fafafa;
        }

        section.models {
            display: none;
        }
    </style>
</head>
<body>
<div id="swagger-ui"></div>
<script src="/plugins/swagger/view/public/assets/swagger/swagger-ui-bundle.js"></script>
<script src="/plugins/swagger/view/public/assets/swagger/swagger-ui-standalone-preset.js"></script>
<script>
    window.onload = function () {

        const ui = SwaggerUIBundle({
            url: "<?php echo cmf_plugin_url('Swagger://Index/config'); ?>",
            dom_id: '#swagger-ui',
            deepLinking: true,
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            plugins: [
                SwaggerUIBundle.plugins.DownloadUrl
            ],
            layout: "StandaloneLayout",
            persistAuthorization: true,
            docExpansion:"none"
        })

        window.ui = ui
    }
</script>
</body>
</html>
