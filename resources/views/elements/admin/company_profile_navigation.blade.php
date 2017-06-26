<div class="profile-sidebar">
    <div class="portlet light profile-sidebar-portlet">
        <div class="profile-userpic">
            <img src="{{ $companyData->getMedia('Company_logo')[0]->getUrl() }}" class="img-responsive pic-bordered" alt=""> </div>
        <div class="profile-usermenu">
            <ul class="nav">
                <li><a href="{{ route('company.profile', ['domain' => app('request')->route()->parameter('company')]) }}" class="active">Overview </a></li>
                @if(Auth::user()->id == $companyData->user->id)
                <li><a href="{{ route('company.edit.profile', ['domain' => app('request')->route()->parameter('company')]) }}">Edit Company Profile </a></li>
                <li><a href="{{ route('company.members', ['domain' => app('request')->route()->parameter('company')]) }}">View Members </a></li>
                @endif
            </ul>
        </div>
    </div>        
</div>