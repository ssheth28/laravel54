@extends('layouts.admin.companyselect')

@section('content')
    <div>
        <h3 class="caption-subject">Select your company</h3>
        <p>Select Company</p>
        
        @foreach($companies as $company)
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-4">
                        <label class="company_name">
                            {{ $company->name }}
                        </label>
                    </div>
                    <div class="col-xs-5">
                        <select class="form-control" name="user_company_roles[]" id="user_company_roles_{{ $company->id }}">
                        @foreach($userCompanyRoles[$company->id] as $userCompanyRole)
                            <option value="{{ $userCompanyRole->id }}">{{ $userCompanyRole->display_name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <a class="btn uie-btn uie-btn-primary pull-right btn-select-company" data-company-slug="{{ $company->slug }}" data-company-id="{{ $company->id }}">{{ __("Select") }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/admin/selectcompany.js') }}" type="text/javascript"></script>
@endsection
