<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu" style="height:90%">
            <li><a class=" " href="{{ route('admin') }}" aria-expanded="true">
                <i class="fa-solid fa-play"></i></i>
                <span class="nav-text">Başlangıç</span>
                </a>
            </li>
            <hr>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                <i class="fa-solid fa-list"></i>
                <span class="nav-text">Domainler</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.domains') }}">Oluşturulan domainler</a></li>
                    <li><a href="{{ route('admin.nondomains') }}">Oluşturulmayan domainler</a></li>
                </ul>
            </li>
            
        </ul>
    </div>
</div>
