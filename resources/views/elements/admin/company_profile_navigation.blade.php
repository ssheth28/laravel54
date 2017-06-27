<div class="profile-sidebar">
    <div class="portlet light profile-sidebar-portlet">
        <div class="profile-userpic">
            @if(count($companyData->getMedia('Company_logo')) > 0)
            <img src="{{ $companyData->getMedia('Company_logo')[0]->getUrl() }}" class="img-responsive pic-bordered" alt=""> </div>
            @else
            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=noimage" class="img-responsive pic-bordered" alt=""> </div>
            @endif
        <div class="profile-usermenu">
            <ul class="nav">
                <li class="active"><a href="{{ route('company.profile', ['domain' => app('request')->route()->parameter('company')]) }}">Overview </a></li>
                @if(Auth::user()->id == $companyData->user->id)
                <li><a href="{{ route('company.edit.profile', ['domain' => app('request')->route()->parameter('company')]) }}">Edit Company Profile </a></li>
                <li><a href="{{ route('company.members', ['domain' => app('request')->route()->parameter('company')]) }}">View Members </a></li>
                @endif
            </ul>
        </div>
    </div>        
</div>