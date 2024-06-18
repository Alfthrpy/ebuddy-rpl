@extends('layouts.base')

@push('style')
<link href="css/carousel.css" rel="stylesheet">
<style>
    body {
        font-family: 'Montserrat', sans-serif;
        background-color: #f8f9fa;
    }

    .container.marketing {
        margin-top: 50px;
    }

    .bd-placeholder-img {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .featurette-heading {
        font-weight: 700;
    }

    .text-body-secondary {
        color: #6c757d;
    }

    .btn-secondary {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .featurette-divider {
        border-top: 1px solid #e0e0e0;
    }

    .welcome-section {
        background: url('https://static.pajakku.com/portal/uploads/webp/f50e9a6d-af76-4b4b-951d-c847a104bc0c.webp') no-repeat center center;
        background-size: cover;
        color: white;
        text-align: center;
        padding: 100px 0;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .welcome-section h1 {
        font-size: 3em;
        font-weight: 700;
    }

    .welcome-section p {
        font-size: 1.5em;
    }
</style>
@endpush

@section('base')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <h2 class="featurette-heading fw-normal lh-1 mb-5 mt-3">Pemerintah <span class="text-body-secondary">Sidoarjo</span></h2>
            <p>
                Governance refers to the mechanisms, processes, and institutions through which individuals and groups articulate their interests, exercise their rights, mediate their differences, and enforce their collective decisions. It encompasses the rules, norms, and procedures that guide the actions of individuals and institutions.
            </p>
            <p>
                Effective governance ensures that resources are used efficiently, public policies are formulated and implemented transparently, and the rights and interests of all members of society are respected and protected. It involves participation, accountability, transparency, responsiveness, and the rule of law.
            </p>
            <p>
                Good governance fosters social cohesion, economic development, and political stability. It promotes trust in government institutions, enhances the legitimacy of the state, and contributes to the well-being of citizens.
            </p>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Key Concepts</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Participation</li>
                        <li class="list-group-item">Accountability</li>
                        <li class="list-group-item">Transparency</li>
                        <li class="list-group-item">Responsiveness</li>
                        <li class="list-group-item">Rule of Law</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class='row'>
        <div class="col-md-8">
            <h2 class="featurette-heading fw-normal lh-1 mb-5 mt-5">Tentang <span class="text-body-secondary">Ebuddy</span></h2>
            <p>
                Governance refers to the mechanisms, processes, and institutions through which individuals and groups articulate their interests, exercise their rights, mediate their differences, and enforce their collective decisions. It encompasses the rules, norms, and procedures that guide the actions of individuals and institutions.
            </p>
            <p>
                Effective governance ensures that resources are used efficiently, public policies are formulated and implemented transparently, and the rights and interests of all members of society are respected and protected. It involves participation, accountability, transparency, responsiveness, and the rule of law.
            </p>
            <p>
                Good governance fosters social cohesion, economic development, and political stability. It promotes trust in government institutions, enhances the legitimacy of the state, and contributes to the well-being of citizens.
            </p>
        </div>
    </div>
</div>
@endsection
