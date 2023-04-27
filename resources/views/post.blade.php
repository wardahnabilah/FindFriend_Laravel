<x-layout>
    <main>
        <div class="container">
            <div class="card card__post">
                <div class="card-header-container">
                    <h3>{{$title}}</h3>
                    <div class="icon-container">
                        <!-- Edit Icon -->
                        <svg class="edit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                            <path d="m16 2.012 3 3L16.713 7.3l-3-3zM4 14v3h3l8.299-8.287-3-3zm0 6h16v2H4z"></path>
                        </svg>
                        <!-- Delete Icon -->
                        <svg class="delete" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                            <path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm10.618-3L15 2H9L7.382 4H3v2h18V4z"></path>
                        </svg>
                    </div>
                </div>
                <div class="small-text posted-on">posted on {{$created_at->format('d F Y')}} by <a href="" class="button-link--blue">{{$author}}</a></div>
                <p>{{$body}}</p>    
            </div>    
        </div>
    </main>
</x-layout>