 <div class="modal-body">
    <div class="note bg-blue" style="border: none">
        <p style="font-size: 18px; text-align: center"><b style="color: #fff;">Login Successfully</b> &nbsp;<i class="fa fa-check-circle greeg-color" style="color: #aff473;"></i></p>
    </div>
    <div class="company-box">
        <p class="box-tlt">Please Select Your Company</p>
            <div class="mt-element-card mt-card-round mt-element-overlay">
                <div class="row">
                    @foreach($companies as $company)
                        <div class="col-lg-4 col-md-4 col-sm-6">                        
                            <div class="mt-card-item">
                                <div class="mt-card-avatar mt-overlay-1">
                                    <img src="http://htmlwazir.peppyemails.com/img/comapny-logo.png">
                                    <div class="mt-overlay">
                                        <ul class="mt-info">
                                            <li>
                                                <a class="btn default btn-outline btn-select-company" href="javascript:void(0)" data-company-slug="{{ $company->slug }}" data-company-id="{{ $company->id }}">
                                                    <i class="icon-link"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="mt-card-content">
                                    <h3 class="mt-card-name">
                                        <a class="btn-select-company" href="javascript:void(0)" data-company-slug="{{ $company->slug }}" data-company-id="{{ $company->id }}">
                                            {{ $company->name }}
                                        </a>
                                    </h3>
                                </div>
                            </div>                    
                        </div>
                    @endforeach
                </div>
        </div>
    </div>
 </div>

 @section('page-core-scripts')
    <script type="text/javascript">
        $('.multi-select').multiSelect();

        
    </script>
@endsection