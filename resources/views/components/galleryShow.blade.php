@if ($multimedia)
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4" id="masonry-grid">
        @foreach ($multimedia as $media)
            <div class="grid-item object-cover">
                <img class="w-full h-full rounded-lg open-img"
                    src="{{ asset('storage/moments/' . $media->moment_id . '/' . $media->name) }}" alt=""
                    data-id="{{ $media->id }}">
                <div class="desc">{{ $media->description }}</div>
            </div>
        @endforeach
    </div>



    <script>
        //masonry

        document.addEventListener('DOMContentLoaded', function() {
            var elem = document.querySelector('#masonry-grid');
            var msnry = new Masonry(elem, {
                itemSelector: '.grid-item',
                columnWidth: '.grid-item',
                percentPosition: true
            });
        });

        //iife para encapsular el código JS y que se autoejecute
        (function() {
            //que cuando se haga click en una imagen que le hemos puesto la clase open-img haga algo
            const openImgElements = document.querySelectorAll('.open-img');
            openImgElements.forEach(openImgElement => {
                openImgElement.addEventListener('click', openImg);
            });

            function openImg(e) {

                const modal = document.createElement('div');
                modal.classList.add(
                    'fixed', 'inset-0', 'bg-black', 'bg-opacity-50', 'flex', 'justify-center', 'items-center',
                    'w-full', 'h-full', 'z-50'
                );
                modal.addEventListener('click', (e) => {
                    document.body.removeChild(modal);
                });

                const content = document.createElement('div');
                content.classList.add('relative', 'w-full', 'max-w-2xl', 'max-h-full');
                content.addEventListener('click', (e) => {
                    e.stopPropagation();
                });
                modal.appendChild(content);
        //boton de cerrar
                const closeBtn = document.createElement('button');
                closeBtn.classList.add('absolute', 'top-8', 'right-8', 'h-12', 'w-12', 'text-white', 'bg-black',
                    'rounded-full', 'flex', 'justify-center', 'items-center');
                closeBtn.innerHTML = 'X';
                closeBtn.addEventListener('click', () => {
                    document.body.removeChild(modal);
                });
                closeBtn.innerHTML =
                    `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>`;
                content.appendChild(closeBtn);
        //boton de descargar
                const downloadBtn = document.createElement('button');
                downloadBtn.classList.add('absolute', 'bottom-8', 'right-24', 'h-12', 'w-12', 'text-white', 'bg-black',
                    'rounded-full', 'flex', 'justify-center', 'items-center');
                downloadBtn.innerHTML = 'X';
                downloadBtn.addEventListener('click', () => {
                    //cojo el data-id de la clase de la imagen
                    const mediaId = e.target.closest('.open-img').dataset.id;
                    //voy a la ruta /multimedia/download/{id} y descargo la imagen
                    window.location.href = '/multimedia/download/' + mediaId;
                });
                downloadBtn.innerHTML =
                    `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>`;
                content.appendChild(downloadBtn);



                const img = document.createElement('img');
                img.src = e.target.src;
                img.classList.add('w-full', 'h-auto', 'max-w-full', 'max-h-full');
                content.appendChild(img);
                // boton de borrar
                if (window.userCanDelete) {
                    const deleteBtn = document.createElement('button');
                    deleteBtn.classList.add('absolute', 'bottom-8', 'right-8', 'h-12', 'w-12', 'text-white',
                        'bg-red-500',
                        'rounded-full', 'flex', 'justify-center', 'items-center');
                    deleteBtn.innerHTML =
                        `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>`;
                    deleteBtn.addEventListener('click', async () => {
                        if (confirm('¿Estás seguro de que quieres borrar esta imagen?')) {
                            // multimedia/{id} tipo delete
                            const token = document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content');
                            const mediaId = e.target.closest('.open-img').dataset.id;
                            const response = await fetch('/multimedia/' + mediaId, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': token,
                                    'Content-Type': 'application/json'
                                }
                            });
                            const result = await response.json();
                            console.log(result);
                            if (result.success) {
                                document.body.removeChild(modal);
                                window.location.reload();
                            } else {
                                alert('No se ha podido borrar la imagen');
                            }
                        }
                    });
                    content.appendChild(deleteBtn);
                }

                document.body.appendChild(modal);
            }


        })();
    </script>
@else
    <p>NO HAY CONTENIDO</p>
@endif
