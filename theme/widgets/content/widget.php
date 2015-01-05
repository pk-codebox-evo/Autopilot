@if(isset($settings['content']) && count($settings['content']))


    @foreach($settings['content'] as $content)
    <section>
    {%

        switch($content['type']) {

            case 'region':

                if (trim($content['value'])) {
                    $cockpit->module('regions')->render($content['value']);
                }

                break;

            case 'markdown':

                echo markdown($content['value']);

                break;

            case 'media':

                if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $content['value'])) {
                %}
                    <img src="{{ $app->pathToUrl($content['value']) }}">
                {%
                } elseif(preg_match('/\.(mp4|mpeg|webv|ogv)$/i', $content['value'])) {
                %}
                    <video src="{{ $app->pathToUrl($content['value']) }}"></video>
                {%
                } else {
                    echo $content['value'];
                }

                break;

            case 'gallery':

                if (count($content['value'])) {
                %}
                    <div class="grid-cells-medium-1-2 grid-cells-small-1-1">
                    @foreach($content['value'] as &$item)
                        <div>
                            <img src="{{ $app->pathToUrl($item['path']) }}" alt="{{ $item['title'] }}">
                        </div>
                    @endforeach
                    </div>
                {%
                }

                break;

            case 'markdown':

                echo markdown($content['value']);

                break;

            default:
                echo is_string($content['value']) ? $content['value'] : json_encode($content['value']);
        }

    %}
    </section>
    @endforeach

@endif