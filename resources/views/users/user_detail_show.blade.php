<div class="portlet light" style="margin: 0; padding: 0;">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject bold uppercase font-dark"><i class="fa fa-file-text" aria-hidden="true"></i> View Details</span>
        </div>
        <div class="tools">
            &nbsp;<a href="" class="collapse"> </a>
            <a href="javascript:;" data-dismiss="modal">&times;</a>
        </div>
        <div class="actions">
            <a class="btn btn-icon-only btn-default" href="{{ url('admin/users') }}/{{ $user->id }}/edit">
                <i class="fa fa-pencil-square-o"></i>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row form-horizontal">
            <div class="col-md-12">
                <div class="col-md-12 col-sm-2 text-center margin-bottom-20">
                    @if(count($user->getMedia('User')) > 0)
                        <img src="{{ $user->getMedia('User')[0]->getUrl() }}" class="img-responsive margin-bottom-10 img-circle" style="width:85px; margin: auto;">
                    @else
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=NoImage" class="img-responsive margin-bottom-10 img-circle" style="width:85px; margin: auto;">
                    @endif
                    <b class="blue-color">{{ $user->person->first_name .' '. $user->person->last_name }}</b>
                </div>
                <fieldset>
                    <legend class="blue-color" align="">Company Information</legend>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>User Role</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">Main Admin</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Email ID</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $user->email }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Department </label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color"> {{ $user->person->department }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Date Of Joining </label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ Carbon\Carbon::parse($user->person->date_of_joining)->format('d-m-Y') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-md-12">
                <fieldset>
                    <legend class="blue-color" align="">Personal Information</legend>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Contact No</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $user->person->mobile_number }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Landline Number</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $user->person->home_phone }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Parent's Contact Number </label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $user->person->parent_contact_number }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Driving Licence No </label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $user->person->driving_licence_number }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Aadhar Card No </label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $user->person->aadhar_card_number }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Voter ID No </label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $user->person->voter_id_number }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Blood Group </label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $user->person->blood_group }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Date Of Birth </label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ Carbon\Carbon::parse($user->person->dob)->format('d-m-Y') }}</label>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Gender </label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $user->person->gender == 0 ? 'Male' : 'Female' }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 text-right">
                                    <label>Status </label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="blue-color">{{ $user->person->status == 1 ? 'Active' : 'Inactive' }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="margin-top-10">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-4 col-sm-4 text-right">
                                    <label>Current Address </label>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <label class="blue-color">{{ $user->person->address['current_address'] }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-4 col-sm-4 text-right">
                                    <label>Permanent Address</label>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <label class="blue-color">{{ $user->person->permanent_address }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>