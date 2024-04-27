@extends('admin.app')
@section('admin')
    @php
        use Illuminate\Foundation\Auth\User;
    @endphp
    <div class="content-body">

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
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

                        <form action="{{ route('veri.al') }}" method="post" enctype="multipart/form-data"
                            class="sm:max-w-xl sm:mx-auto lg:mx-0">
                            @csrf
                            <div class="sm:flex">
                                <div class="min-w-0 flex-1">
                                    <input id="file" name="dosya" type="file" style="background-color: beige"
                                        accept=".xlsx, .xls, .ods"
                                        class="block w-full px-4 py-3 rounded-md border-0 text-base text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300 focus:ring-offset-gray-900">
                                </div>
                                <div class="mt-3 sm:mt-0 sm:ml-3">
                                    <button type="submit"
                                        class="block w-full py-3 px-4 rounded-md shadow bg-indigo-500 text-white font-medium hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300 focus:ring-offset-gray-900">İçeriği
                                        Aktar</button>
                                </div>
                            </div>
                            @if (session('message'))
                                <div class="alert alert-{{ session('alert-type') }}">
                                    {{ session('message') }}
                                </div>
                            @endif
                        </form>
                        <div class="col-xl-12">
                              <h5 class="mt-5">Veritabanında toplam veri : {{ $countRow}}</h5>
                        <form action="{{ route('veri.cikart') }}" method="GET">
                            @csrf
                          
                            <label for="dataCount" class="mt-5">Almak istediğiniz veri Sayısı:</label>
                            <input type="number" name="count" id="dataCount">
                            <label for="sort_by">Sıralama Türü:</label>
                            <select name="sort_by">
                                <option value="asc">İlk</option>
                                <option value="desc">Son</option>
                            </select>
                            <button type="submit"
                                class="block w-full py-3 px-4 rounded-md shadow bg-indigo-500 text-white font-medium hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300 focus:ring-offset-gray-900">OLUŞTURULMUŞ VERİYİ
                                ÇIKART</button>
                        </form>

                        <form action="{{ route('non.veri.cikart') }}" method="GET">
                            @csrf
                            <label for="dataCount" class="mt-5">Almak istediğiniz veri Sayısı:</label>
                            <input type="number" name="count" id="dataCount">
                            <label for="sort_by">Sıralama Türü:</label>
                            <select name="sort_by">
                                <option value="asc">İlk</option>
                                <option value="desc">Son</option>
                            </select>
                            <button type="submit"
                                class="block w-full py-3 px-4 rounded-md shadow bg-indigo-500 text-white font-medium hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300 focus:ring-offset-gray-900">OLUŞTURULMAMIŞ VERİYİ
                                ÇIKART</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
@endsection
