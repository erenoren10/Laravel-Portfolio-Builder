@extends('admin.app')
@section('admin')
    <link href="{{ asset('backend/vendor') }}/datatables/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="{{ asset('backend/vendor') }}/jquery-nice-select/css/nice-select.css" rel="stylesheet" />
    <link href="{{ asset('backend/css') }}/style.css" rel="stylesheet" />
    <style>
        /* "Seçilenleri Gönder" butonu için stil */
        .gonderbuton {
            padding: 10px 15px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .gonderbuton:hover {
            background-color: #2974a7;
        }

        /* "Tümünü Seç" checkbox'ı için etiketin stil */
        .tumunusec-label {
            display: inline-block;
            margin-bottom: 10px;
            cursor: pointer;
        }

        /* "Tümünü Seç" checkbox'ı için stil */
        .tumunusec {
            margin-right: 5px;
            cursor: pointer;
        }

        /* Tablo içindeki checkbox'lar için stil */
        .select-checkbox {
            cursor: pointer;
        }

        #selectAllButton {
            background-color: #4CAF50;
            /* Yeşil renk */
            color: white;
            /* Beyaz renk */
            padding: 10px 15px;
            /* Düğme içerisindeki iç boşluklar */
            border: none;
            /* Kenarlık yok */
            border-radius: 4px;
            /* Köşeleri yuvarla */
            cursor: pointer;
            /* Göstergeyi el simgesine çevir */
        }

        #selectAllButton:hover {
            background-color: #45a049;
            /* Hover olduğunda renk değiştir */
        }
 
/* İkinci Formun Stilleri */
#dataCount {
    margin-right: 10px;
}

#dataCount, button {
    padding: 10px;
}
    </style>


    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                        <div class="card-header">
                            <h4 class="card-title">Oluşturulmayan domainler</h4> <h6> Toplam veri = {{ $counts}} </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <form method="get" action="{{ route('admin.nondomains') }}">
                                        <label for="perPage">Sayfa Başına Gösterilecek Öğe Sayısı:</label>
                                        <select name="perPage" id="perPage" onchange="this.form.submit()">
                                            <option value="100"
                                                {{ Request::input('perPage', 100) == 100 ? 'selected' : '' }}>100
                                            </option>
                                            <option value="500"
                                                {{ Request::input('perPage', 100) == 500 ? 'selected' : '' }}>500
                                            </option>
                                            <option value="1000"
                                                {{ Request::input('perPage', 100) == 1000 ? 'selected' : '' }}>
                                                1000</option>
                                            <!-- Diğer seçenekleri buraya ekleyebilirsiniz -->
                                        </select>
                                    </form>
                                    <form action="{{ route('update.records') }}" method="GET">
                                        <label for="dataCount">Sayfa Yenilendiğinde Yüklenecek Veri Sayısı:</label>
                                        <select name="dataCount" id="dataCount">
                                            <option value="{{$records_per_minute->records_per_minute}}">{{$records_per_minute->records_per_minute}}</option>
                                            <option value="5">5</option>
                                            <option value="15">15</option>
                                            <option value="25">25</option>
                                            <!-- Diğer seçenekler... -->
                                        </select>
                                        <button type="submit" class="btn btn-success gonderbuton" >Uygula</button>
                                    </form>
                                </div>
                                <div class="col-6">
                                    <form action="{{ route('admin.searchdomains') }}" method="POST"
                                        class="form-inline my-2 my-lg-0">
                                        @csrf

                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Arama yap...">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="submit">Ara</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <form action="{{ route('add.domain') }}" method="post">
                                    @csrf
                                    <div class="table-toolbar">
                                        <button type="button" id="selectAllButton" class="btn btn-primary">Tümünü
                                            Seç</button>
                                        <button type="submit" class="btn btn-success gonderbuton">Seçilenleri
                                            Gönder</button>
                                    </div>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">SN</th>
                                                <th scope="col">Domain</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($i = $records->firstItem())
                                            @foreach ($records as $domain)
                                                <tr>
                                                    <td><input type="checkbox" name="selectedDomains[]"
                                                            class="select-checkbox" value="{{ $domain->domain }}"></td>
                                                    <td>{{ $i++ }}</td>
                                                    <td><a href="https://{{ $domain->domain }}"
                                                            target="_blank">{{ $domain->domain }}</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="pagination-container">
                                        {{ $records->links() }}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        document.getElementById('selectAllButton').addEventListener('click', function() {
            var checkboxes = document.querySelectorAll('.select-checkbox');
            var selectAllChecked = true;

            checkboxes.forEach(function(checkbox) {
                if (!checkbox.checked) {
                    selectAllChecked = false;
                    checkbox.checked = true;
                }
            });

            // Tüm checkbox'lar zaten seçiliyse, seçimleri kaldır
            if (selectAllChecked) {
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = false;
                });
            }
        });
    </script>

    <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('backend/vendor') }}/global/global.min.js"></script>
    <script src="{{ asset('backend/vendor') }}/chart.js/Chart.bundle.min.js"></script>

    <script src="{{ asset('backend/vendor') }}/apexchart/apexchart.js"></script>

    <script src="{{ asset('backend/vendor') }}/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend/js') }}/plugins-init/datatables.init.js"></script>
    <script src="{{ asset('backend/vendor') }}/jquery-nice-select/js/jquery.nice-select.min.js"></script>
    <script src="{{ asset('backend/js') }}/custom.min.js"></script>
    <script src="{{ asset('backend/js') }}/dlabnav-init.js"></script>
    <script src="{{ asset('backend/js') }}/demo.js"></script>
    <script src="{{ asset('backend/js') }}/styleSwitcher.js"></script>
@endsection
