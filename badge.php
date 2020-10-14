<?php
    // Bot token to access Discord's users API (fetch Username and Tag)
    $BOT_TOKEN = "Bot Token";

    // Return an SVG with no cache (for github image update)
    header("content-type: image/svg+xml;charset=utf-8");
    header("Cache-Control: max-age=0, no-cache, no-store, must-revalidate");

    // Make a request to discord's users api with a dummy bot token
    $ch = curl_init("https://discord.com/api/users/" . $_GET["id"]);

    if (!$ch) {
        die("Couldn't initialize a cURL handle");
    }
    
    $options = array(
        CURLOPT_RETURNTRANSFER => true,                                 // return web page
        CURLOPT_HEADER         => false,                                // don't return headers
        CURLOPT_ENCODING       => "utf-8",                              // handle all encodings
        CURLOPT_CONNECTTIMEOUT => 20,                                   // timeout on connect
        CURLOPT_TIMEOUT        => 20,                                   // timeout on response
        CURLOPT_VERBOSE        => 1,
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bot " . $BOT_TOKEN,
        ),
    );
    
    curl_setopt_array($ch, $options);
    $data = curl_exec($ch);
    $result = array();
    
    if (curl_errno($ch)) {
        exit("cURL error.");
    }

    curl_close($ch);

    // Get the result as JSON array
    $result = json_decode($data);
    
    // Make the test the resulting name#tag retrieved from id
    $text = $result->username . "#" . $result->discriminator;
    $font_size = 11;
    $font_file = "fonts/verdana.ttf";

    // Calculate text_length
    $text_size = imagettfbbox($font_size, 0, $font_file, $text);
    $text_lentgh = floor(($text_size[0] + $text_size[2]) * 7.47);

    // Calculate text_x to center the text and rect_witdh to match the length
    $text_x = 680 + 100 + $text_lentgh / 2;
    $rect_width = 20 + $text_lentgh / 10;
?>

<!-- Generated SVG -->
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="<?php echo 68 + $rect_width; ?>" height="20" role="img" aria-label="Discord: Xiloe#5270">
    <title>Discord: <?php echo $text; ?></title>
    <g shape-rendering="crispEdges">
        <rect width="68" height="20" fill="#555"/>
        <rect x="68" width="<?php echo $rect_width; ?>" height="20" fill="#7289da"/>
    </g>
    <g fill="#fff" text-anchor="middle" font-family="Verdana,Geneva,DejaVu Sans,sans-serif" text-rendering="geometricPrecision" font-size="110">
        <image x="5" y="3" width="14" height="14" xlink:href="data:image/svg+xml;base64,PHN2ZyB2aWV3Qm94PSIwIDAgMjQgMjQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgZmlsbD0iIzcyODlEQSI+PHBhdGggZD0iTTQuMzM0IDQuNjM2YzEuMzUxLS43MjUgMi44NTItMS4yMjIgNC4zOTMtMS4yNjhsLjIwNS4yNWMtMS4zNjMuMzk5LTIuNjkzLjkyNS0zLjkyIDEuNjQ1LS41MDcuMzEyLTEuMDIzLjYyNC0xLjQ2MiAxLjAyOSAxLjEwNi0uNTUzIDIuMjM3LTEuMDc5IDMuNDM4LTEuMzk0LjY0OC0uMTgzIDEuMzAyLS4zNTEgMS45NzItLjQyOCAxLjYwNC0uMjI1IDMuMjM2LS4zMjUgNC44NS0uMTQ0YTE3LjYzNyAxNy42MzcgMCAwIDEgMy4zOTUuNzMyIDE4LjU5NiAxOC41OTYgMCAwIDEgMi44MDUgMS4yMDFjLS4yNC0uMjQzLS41MjQtLjQzNC0uODA2LS42MjItMS4yOTUtLjg2NC0yLjc0MS0xLjQ4LTQuMjI0LTEuOTQuMTMzLS4xMjMuMjItLjM2OS40NDEtLjMzIDEuOTQ3LjEyNCAzLjgxOS44ODYgNS40IDIuMDEuMTE0LjA3NC4yNDMuMTQ0LjI5MS4yOGEyOC4zMzMgMjguMzMzIDAgMCAxIDIuMjA4IDYuMjAxYy40MTQgMS44LjY1MiAzLjY0Mi42NzggNS40ODkuMDA1LjA5Mi4wMDUuMTkyLS4wNi4yNjctMS4wNSAxLjQ2Ni0yLjcwOSAyLjQxNy00LjQ1MSAyLjgwNWE5LjI1NCA5LjI1NCAwIDAgMS0xLjc3Ny4yMTggODEuNjkxIDgxLjY5MSAwIDAgMS0xLjM1NS0xLjY3NGMuNjI0LS4xNjIgMS4yMTUtLjQyNyAxLjc4LS43MzMuNzQtLjQzNCAxLjQzNy0uOTgyIDEuOTI2LTEuNjk0LS43MDEuNDUtMS40MzQuODU0LTIuMjE2IDEuMTVhMTguNzMzIDE4LjczMyAwIDAgMS0xLjUyMS41NTZjLS44ODQuMjgyLTEuODAzLjQzNC0yLjcyMi41NDMtMS4wNi4xMTUtMi4xMzMuMDgtMy4xOTEtLjA0LTEuMS0uMTE4LTIuMTc3LS4zOTUtMy4yMjYtLjc0LS44NjUtLjMxNS0xLjc0My0uNjI1LTIuNTI0LTEuMTIyLS4yLS4xMjYtLjQtLjI1Mi0uNjA1LS4zNjguMzA5LjQ3Ny43NDMuODU2IDEuMTgxIDEuMjFhNy41NSA3LjU1IDAgMCAwIDIuNDAyIDEuMiA2OS4yNDYgNjkuMjQ2IDAgMCAxLTEuMTgyIDEuNDYyYy0uMDk0LjA5OC0uMTU1LjI4Mi0uMzIzLjI0NWE5LjM5OCA5LjM5OCAwIDAgMS0yLjQ0LS40MjNjLTEuMDg2LS4zNzYtMi4xMjItLjk0Ny0yLjkzNy0xLjc2Ny0uMjg0LS4yODEtLjU2Mi0uNTgyLS43NTctLjkzNC0uMDItMy4wNjYuNjIyLTYuMTA5IDEuNjUxLTguOTg3LjM2OS0xLjAxNS43ODQtMi4wMTcgMS4yOTItMi45Ny40MjEtLjM2LjkwOS0uNjQyIDEuMzkxLS45MTVtMy41ODMgNi40MTJjLS43MjkuMDgyLTEuMzY0LjU5Ni0xLjY1IDEuMjYyLS40NjIuOTk4LS4xNDcgMi4zMDguNzcgMi45MzUuNDY0LjMyIDEuMDY5LjQzNSAxLjYxNC4yODIuNTk5LS4xNDcgMS4wOS0uNjAyIDEuMzU1LTEuMTUuNDQ1LS45MDIuMjY3LTIuMDgzLS40NjUtMi43ODUtLjQzLS40LTEuMDM2LS42MjYtMS42MjQtLjU0NG03LjM3Ni4wMThjLTEuMDE4LjE5LTEuNzQ4IDEuMTk2LTEuNzM1IDIuMjExLS4wMTMuOC4zODYgMS42MTUgMS4wOCAyLjAzNC40Ni4yOTQgMS4wNS4zNTYgMS41Ny4yLjU3OS0uMTYgMS4wNS0uNjEgMS4zMDQtMS4xNDQuNDYyLS45NC4yMy0yLjE4Ni0uNTc5LTIuODYzYTEuOTk0IDEuOTk0IDAgMCAwLTEuNjQtLjQzOHoiLz48L3N2Zz4="/>
        <text x="435" y="140" transform="scale(.1)" fill="#fff" textLength="420">Discord</text>
        <text x="<?php echo $text_x; ?>" y="140" transform="scale(.1)" fill="#fff" textLength="<?php echo $text_lentgh; ?>"><?php echo $text; ?></text>
    </g>
</svg>