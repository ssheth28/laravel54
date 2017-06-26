<div class="profile-sidebar">
    <div class="portlet light profile-sidebar-portlet">
        <div class="profile-userpic">
            <img src="{{ $user->getMedia('User')[0]->getUrl() }}" class="img-responsive pic-bordered" alt=""> 
        </div>
        <div class="profile-usermenu">
            <ul class="nav">
                <li class="active">
                    <a href="{{ route('user.profile', ['domain' => app('request')->route()->parameter('company')]) }}">Overview </a>
                </li>
                <li>
                    <a href="{{ route('user.edit.profile', ['domain' => app('request')->route()->parameter('company')]) }}">Edit Profile </a>
                </li>
                <li>
                    <a href="{{ route('user.password', ['domain' => app('request')->route()->parameter('company')]) }}">Change Password </a>
                </li>
            </ul>
        </div>
    </div>              
</div>
