<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Account created</title>

    <!-- Boostrap CSS only -->
    <style>
        body {
            font-family: 'Avenir', sans-serif;
        }

        hr {
            margin: 1rem 0;
            color: inherit;
            background-color: currentColor;
            border: 0;
            opacity: 0.25;
        }

        hr:not([size]) {
            height: 1px;
        }

        h6, .h6, h5, .h5, h4, .h4, h3, .h3, h2, .h2, h1, .h1 {
            margin-top: 0;
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        h1, .h1 {
            font-size: calc(1.375rem + 1.5vw);
        }

        @media (min-width: 1200px) {
            h1, .h1 {
                font-size: 2.5rem;
            }
        }

        h2, .h2 {
            font-size: calc(1.325rem + 0.9vw);
        }

        @media (min-width: 1200px) {
            h2, .h2 {
                font-size: 2rem;
            }
        }

        h3, .h3 {
            font-size: calc(1.3rem + 0.6vw);
        }

        @media (min-width: 1200px) {
            h3, .h3 {
                font-size: 1.75rem;
            }
        }

        h4, .h4 {
            font-size: calc(1.275rem + 0.3vw);
        }

        @media (min-width: 1200px) {
            h4, .h4 {
                font-size: 1.5rem;
            }
        }

        h5, .h5 {
            font-size: 1.25rem;
        }

        h6, .h6 {
            font-size: 1rem;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        img,
        svg {
            vertical-align: middle;
        }

        table {
            caption-side: bottom;
            border-collapse: collapse;
        }

        caption {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            color: #6c757d;
            text-align: left;
        }

        th {
            text-align: inherit;
            text-align: -webkit-match-parent;
        }

        thead,
        tbody,
        tfoot,
        tr,
        td,
        th {
            border-color: inherit;
            border-style: solid;
            border-width: 0;
        }

        .d-flex {
            display: flex !important;
        }

        .justify-content-center {
            justify-content: center !important;
        }

        .flex-column {
            flex-direction: column !important;
        }

        .table {
            --bs-table-bg: transparent;
            --bs-table-accent-bg: transparent;
            --bs-table-striped-color: #212529;
            --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
            --bs-table-active-color: #212529;
            --bs-table-active-bg: rgba(0, 0, 0, 0.1);
            --bs-table-hover-color: #212529;
            --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            vertical-align: top;
            border-color: #dee2e6;
        }

        .table > :not(caption) > * > * {
            padding: 0.5rem 0.5rem;
            background-color: var(--bs-table-bg);
            border-bottom-width: 1px;
            box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
        }

        .table > tbody {
            vertical-align: inherit;
        }

        .table > thead {
            vertical-align: bottom;
        }

        .table > :not(:first-child) {
            border-top: 2px solid currentColor;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-bordered > :not(caption) > * {
            border-width: 1px 0;
        }

        .table-bordered > :not(caption) > * > * {
            border-width: 0 1px;
        }

        .table-borderless > :not(caption) > * > * {
            border-bottom-width: 0;
        }

        .table-borderless > :not(:first-child) {
            border-top-width: 0;
        }

        .table-striped > tbody > tr:nth-of-type(odd) > * {
            --bs-table-accent-bg: var(--bs-table-striped-bg);
            color: var(--bs-table-striped-color);
        }

        .table-hover > tbody > tr:hover > * {
            --bs-table-accent-bg: var(--bs-table-hover-bg);
            color: var(--bs-table-hover-color);
        }

        .m-auto {
            margin: auto !important;
        }

        .p-2 {
            padding: 0.5rem !important;
        }

        .p-3 {
            padding: 1rem !important;
        }

        .fst-italic {
            font-style: italic !important;
        }

        .fw-bold {
            font-weight: 700 !important;
        }
    </style>
</head>
<body class="p-3">
<div class="d-flex justify-content-center">
{{--    <div class="d-flex flex-column">--}}
{{--        <div class="d-flex justify-content-center">--}}
{{--            <img class="m-auto"--}}
{{--                 src="https://drive.google.com/uc?id=1_0zHBYlRvht9_rBbrV6w_FPUFYAGWDHw"--}}
{{--                 alt="Pether" width="100px">--}}
{{--        </div>--}}
        <h3>{{$iTechGroup->name ?? ""}} group successfully created</h3>
{{--    </div>--}}
</div>
<section>
    <p>Hello {{ $iTechGroup->representativeFirstName ?? ""}},</p>
    <p>Below are the different accounts created by type: </p>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Savings ({{$savingsAccount->accType ?? ""}})</th>
                <th scope="col">Operations ({{$operationsAccount->accType ?? ""}})</th>
                <th scope="col">Welfare ({{$welfareAccount->accType ?? ""}})</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="fst-italic fw-bold">Name</td>
                <td>{{$savingsAccount->name ?? ""}}</td>
                <td>{{$operationsAccount->name ?? ""}}</td>
                <td>{{$welfareAccount->name ?? ""}}</td>
            </tr>
            <tr>
                <td class="fst-italic fw-bold">Number</td>
                <td>{{$savingsAccount->numcpt ?? ""}}</td>
                <td>{{$operationsAccount->numcpt ?? ""}}</td>
                <td>{{$welfareAccount->numcpt ?? ""}}</td>
            </tr>
            <tr>
                <td class="fst-italic fw-bold">Initial Balance</td>
                <td>{{number_format($savingsAccount->initialBal ?? 0, 2)}}</td>
                <td>{{number_format($operationsAccount->initialBal ?? 0, 2)}}</td>
                <td>{{number_format($welfareAccount->initialBal ?? 0, 2)}}</td>
            </tr>
            <tr>
                <td class="fst-italic fw-bold">Created at</td>
                <td>{{$savingsAccount->created_at ?? ""}}</td>
                <td>{{$operationsAccount->created_at ?? ""}}</td>
                <td>{{$welfareAccount->created_at ?? ""}}</td>
            </tr>
            </tbody>
        </table>
    </div>
{{--    <div class="d-flex justify-content-center">--}}
        <img class="m-auto" src="https://drive.google.com/uc?id=1_0zHBYlRvht9_rBbrV6w_FPUFYAGWDHw" alt="Pether"
             width="100px">
{{--    </div>--}}
</section>
</body>
<footer>
    <hr>
    <p class="fst-italic">If you did not subscribe to this service, kindly ignore this mail.</p>
    <p class="fw-bold">THIS EMAIL WAS AUTO-GENERATED - DO NOT REPLY TO THIS EMAIL</p>
</footer>
</html>
