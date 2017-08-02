<div class="form-body">
    <div class="row">
        <div class="col-md-12">
            <fieldset>
                <legend class="blue-color">General</legend>
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <div class="input-group select2-bootstrap-prepend">
                                <span class="input-group-addon no-bg"><i class="fa fa-at blue-color"></i></span>
                                {!! Form::text('position_name', $from == 'edit' ? $vacancy->position_name : null, ['class' => 'form-control', 'placeholder' => 'Position Name']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <div class="input-group select2-bootstrap-prepend">
                                <span class="input-group-addon no-bg"><i class="fa fa-building-o blue-color"></i></span>
                                {!! Form::select('department_name', $departments,  $from == 'edit' ? $vacancy->department_id : null, ['class' =>'form-control select2 select2-allow-clear select2-hide-search-box', 'placeholder' => '-- Select Department Name --']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                            <div class="input-group select2-bootstrap-prepend">
                                <span class="input-group-addon no-bg"><i class="fa fa-qrcode blue-color"></i></span>
                                {!! Form::text('no_of_vacancies', $from == 'edit' ? $vacancy->no_of_vacancies : null, ['class' => 'form-control', 'placeholder' => 'No. Of Vacancy']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-9">
            <button type="submit" class="btn blue">Submit</button>
            <button type="reset" class="btn default">Reset</button>
        </div>
    </div>
</div>