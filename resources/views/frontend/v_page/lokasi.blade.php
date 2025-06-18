@extends('frontend.v_layouts.app')
@section('content')
    <!-- template -->

    <div class="row">
        <div class="col-md-12">
            <div class="billing-details">
                <p> {{ $judul }} </p>
                <div class="section-title">
                    <h3 class="title">{{ $subJudul }} </h3>
                </div>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4078.9963214610425!2d109.17640867515925!3d-6.963133368176675!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb900528323f3%3A0xcf72f60fd8c99a68!2sToko%20Pancing%20Dika%20Fishing!5e1!3m2!1sid!2sid!4v1750101149855!5m2!1sid!2sid"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>

                </div>
            </div>
        </div>
    </div>

    <!-- end template-->
@endsection
