@extends('layout.main')

@section('content')
    <section>
        <div class="">
            <div class="container">
                <div class="" style="padding-top: 128px; padding-bottom: 128px;">
                    <h1 class="text-center font-fredoka font-size-68 font-weight-600 line-height-76 color-primary-2">Kamu itu sangat <br> <span class="font-fredoka color-primary-1">Berharga</span></h1>
                    <p class="text-center font-size-16 font-weight-400 mt-3 d-none d-md-block">“kamu terlalu berharga untuk kalimat <b>“...aku gk berguna...”</b>. Kamu hebat sudah bisa <br> bertahan sampai detik ini, hal menyakitkan apapun yang pernah kamu alami membuat <br> kamu jadi sekuat sekarang. Siapa tau cerita kamu bisa bikin orang lain sehebat kamu juga loh, <br> yuk saling sharing!</p>
                    <p class="text-center font-size-16 font-weight-400 mt-3 d-block d-md-none">“kamu terlalu berharga untuk kalimat <b>“...aku gk berguna...”</b>. Kamu hebat sudah bisa bertahan sampai detik ini, hal menyakitkan apapun yang pernah kamu alami membuat kamu jadi sekuat sekarang. Siapa tau cerita kamu bisa bikin orang lain sehebat kamu juga loh, yuk saling sharing!</p>
                    <x-button.secondary-white class="font-size-14 font-weight-400 d-block mx-auto" onclick="location.href = '{{ route('login') }}'">Hands my Hand</x-button.secondary-white>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="bg-linear">
            <div class="container">
                <div class="row padding-top-66 padding-bottom-66">
                    <div class="col-md-6 d-flex align-items-center">
                        <div>
                            <h1 class="font-size-40 font-weight-600 color-primary-2">Ayo Sini...</h1>
                            <p class="font-size-18 font-weight-400 mt-4" style="text-align: justify">
                                Jangan kamu pendam sendiri...kami siap kok dengar cerita atau keluh kesah kamu. Banyak juga kok teman lainnya yang mungkin sama seperti kamu, mungkin kita bisa saling berbagi dan menguatkan. Kalo gitu...ayo gabung bareng kita. Kamu gk akan sendiri lagi deh
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('assets/landing/img/hugs.png') }}" class="d-none d-md-block mx-auto" width="380" alt="">
                        <img src="{{ asset('assets/landing/img/hugs.png') }}" class="d-block d-md-none mx-auto mt-4" width="280" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container margin-top-128">
            <h1 class="font-size-40 font-weight-600 color-primary-2 text-center mb-5">Cerita Terpopuler</h1>
            <div class="row" id="pad">
                @foreach ($data as $item)
                    <div class="col-md-3 col-6 my-3 d-flex align-items-stretch">
                        <a href="{{ route('posting', ['id' => $item->id]) }}">
                            <x-card.rounded see="{{ $item->see }}" like="{{ $item->like }}"
                                title="{{ $item->title }}" btn="Baca"
                                img="{{ $item->cover ? asset('images/' . $item->cover) : asset('images/lost_home.jpg') }}">
                            </x-card.rounded>
                        </a>
                    </div>
                @endforeach
            </div>
            <x-button.secondary-white class="font-size-14 font-weight-400 d-block mx-auto mt-4" onclick="location.href = '{{ route('beranda') }}'">See More</x-button.secondary-white>
        </div>
    </section>

    <section>
        <div class="bg-linear margin-top-128">
            <div class="container">
                <div class="row padding-top-66 padding-bottom-66">
                    <div class="col-md-6">
                        <h1 class="font-size-40 font-weight-600 color-primary-2 text-md-start text-center">Contact Us</h1>
                        <img src="{{ asset('assets/landing/img/contact-us.png') }}" class="d-none d-md-block" width="350" alt="">
                        <img src="{{ asset('assets/landing/img/contact-us.png') }}" class="d-block d-md-none mx-auto mt-4" width="280" alt="">
                        <p class="font-size-18 font-weight-400 mt-4 d-none d-md-block">Lorem ipsum dolor sit amet consectetur adipisicing elit. <br> Quos soluta, voluptatibus optio consequuntur eaque esse <br> dicta aperiam, aut expedita unde laudantium excepturi exercitationem aliquid, laboriosam totam qui.</p>
                        <p class="font-size-18 font-weight-400 mt-4 d-block d-md-none" style="text-align: justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos soluta, voluptatibus optio consequuntur eaque esse dicta aperiam, aut expedita unde laudantium excepturi exercitationem aliquid, laboriosam totam qui.</p>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                        <div class="card card-contact-us shadow bg-white p-5 mt-4">
                            <form action="">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Your Name</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label">Email Address</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <x-button.secondary-green class="font-size-14 font-weight-400 w-100" onclick="location.href = '/project'">Send</x-button.secondary-green>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('custom-script')
        {{-- <script>
            let visibilitas = 1;
            $('#visibilitas').on('change', function() {
                visibilitas = $(this).val();
                fetchData();
            })

            function fetchData() {
                $.ajax({
                    url: `fetchData/${visibilitas}`,
                    method: "GET",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        // console.log(data.data);
                        let element = "";
                        $.each(data.data, function(index, value) {
                            element += `
                                <div class="col-md-3 col-6 my-3 d-flex align-items-stretch">
                                    <a href="edit/${value.id}">
                                        <x-card.rounded see="${value.see}" like="${value.like}" title="${value.title}" btn="Sunting" img="{{ URL::asset('images/${value.cover}') }}">
                                            <a href="delete/${value.id}">
                                                <x-button.primary-white class="w-100 mt-3">Hapus</x-button.primary-white>
                                            </a>
                                        </x-card.rounded>
                                    </a>
                                </div>
                            `;
                        })

                        $("#pad").html(element)
                        // console.log(data)
                    },
                    error: function(error) {
                        console.log(error.message);
                    }
                })
            }
        </script> --}}
    @endpush
@endsection