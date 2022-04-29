<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Catálogo</title>
    <style>
        /*reset */
        html, body, div, span, applet, object, iframe,
        h1, h2, h3, h4, h5, h6, p, blockquote, pre,
        a, abbr, acronym, address, big, cite, code,
        del, dfn, em, img, ins, kbd, q, s, samp,
        small, strike, strong, sub, sup, tt, var,
        b, u, i, center,
        dl, dt, dd, ol, ul, li,
        fieldset, form, label, legend,
        table, caption, tbody, tfoot, thead, tr, th, td,
        article, aside, canvas, details, embed,
        figure, figcaption, footer, header, hgroup,
        menu, nav, output, ruby, section, summary,
        time, mark, audio, video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }
        /* HTML5 display-role reset for older browsers */
        article, aside, details, figcaption, figure,
        footer, header, hgroup, menu, nav, section {
            display: block;
        }
        body {
            line-height: 1;
        }
        ol, ul {
            list-style: none;
        }
        blockquote, q {
            quotes: none;
        }
        blockquote:before, blockquote:after,
        q:before, q:after {
            content: '';
            content: none;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
        /*end of reset*/

        table {
            border-collapse: collapse;
            margin: 25px auto;
            padding: 0 50px;
            font-size: 14px;
            font-family: sans-serif;
            max-width: 1000px !important;
            width: 100%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        table thead tr {
            background-color: #f8f8f8;
            color: #333;
            text-align: center;
        }

        table th,
        table td {
            max-width: 150px;
            width: 100%;
            padding: 12px 15px;
        }

        table th img{
            width: 100px;
        }

        table td img{
            width: 150px;
        }

        table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }
    </style>
</head>
<body>
<main>
    @foreach($automakers as $automaker)

        <table>
            <thead>
            <tr>
                <th scope="col">
                    Produto
                </th>
                <th scope="col">
                    Código Interno
                </th>
                <th scope="col">
                    Código OEM
                </th>
                <th scope="col">
                    Descrição
                </th>
                <th scope="col">
{{--                    <img src="{{ url(Storage::url($automaker->logo)) }}" alt="Logo {{ $automaker->name }}" class="h-20">--}}
                    <img src="{{ url(asset('storage/' . $automaker->logo)) }}" alt="Logo {{ $automaker->name }}">
                </th>
            </tr>
            </thead>
            <tbody>

            @foreach($products as $product)
                @if($product->cars()->first()->automaker_id == $automaker->id)
                    <tr>
                        <td>
                            <img src="{{ url(asset('storage/' . $product->thumb)) }}" alt="Logo {{ $product->name }}">
                        </td>
                        <td>
                            {{ $product->internal_code }}
                        </td>
                        <td>
                            {{ $product->oem_code }}
                        </td>
                        <td colspan="2">
                            <p>{{ $product->name }}</p>
                            <br>
                            @foreach($product->cars()->get() as $car)
                                @if($car->automaker_id == $automaker->id)
                                    <p>{{ $car->name . ($car->model != null ? ' - ' . $car->model : null) . ' - ' . $car->engine . ' - ' . $car->initial_year . '/' . $car->final_year}}</p>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    @endforeach
</main>
</body>
</html>
