<x-admin-layout>
    <div class="flex flex-col justify-between">
        <div class="flex-grow">
            <div class="container mx-auto px-4 py-6">
                <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
                <p>Bienvenido al Sistema de Administración de <b>Negocios Puerto Montt</b></p>
                <!-- Add your dashboard content here -->
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4">
        <div class="grid gap-2 grid-cols-1 md:grid-cols-4">
            <div class="block rounded-lg bg-primary text-white shadow-secondary-1 relative">
                <div class="icon-bg text-9xl absolute opacity-10 right-4 top-2 overflow-hidden z-0">
                    <i class="fa-solid fa-user-group"></i>
                </div>
                <div class="relative p-6 z-10">
                    <h5 class="mb-2 text-xl leading-tight">
                        Usuarios registrados
                    </h5>
                    <p class="text-5xl font-bold">
                        {{ $user_count }}
                    </p>
                    <div class="text-small mt-2 text-right">
                        <a href="{{ route('admin_users.index') }}" class="text-white align-end mb-2">Ver todos &Gt;</a>
                    </div>
                </div>
            </div>

            <div class="block rounded-lg bg-success text-white shadow-secondary-1 relative">
                <div class="icon-bg text-9xl absolute opacity-10 right-4 top-2 overflow-hidden z-0">
                    <i class="fas fa-building"></i>
                </div>
                <div class="relative p-6 z-10">
                    <h5 class="mb-2 text-xl leading-tight">
                        Negocios
                    </h5>
                    <p class="text-5xl font-bold">
                        {{ $business_count }}
                    </p>
                    <div class="text-small mt-2 text-right">
                        <a href="{{ route('admin_business.index') }}" class="text-white mb-2">Ver todos &Gt;</a>
                    </div>
                </div>
            </div>

            <div class="block rounded-lg bg-danger text-white shadow-secondary-1 relative">
                <div class="icon-bg text-9xl absolute opacity-10 right-4 top-2 overflow-hidden z-0">
                    <div class="fas fa-box"></div>
                </div>
                <div class="relative p-6 z-10">
                    <h5 class="mb-2 text-xl leading-tight">
                        Productos
                    </h5>
                    <p class="text-5xl font-bold">
                        {{ $product_count }}
                    </p>
                    <div class="text-small mt-2 text-right">
                        <a href="{{ route('admin_product.index') }}" class="text-white mb-2">Ver todos &Gt;</a>
                    </div>
                </div>
            </div>

            <div class="block rounded-lg bg-warning text-white shadow-secondary-1 relative">
                <div class="icon-bg text-9xl absolute opacity-10 right-4 top-2 overflow-hidden z-0">
                    <div class="fas fa-hammer"></div>
                </div>
                <div class="relative p-6 z-10">
                    <h5 class="mb-2 text-xl leading-tight">
                        Oficios
                    </h5>
                    <p class="text-5xl font-bold">
                        {{ $trade_count }}
                    </p>
                    <div class="text-small mt-2 text-right">
                        <a href="{{ route('admin_trade.index') }}" class="text-white text-right mb-2">Ver todos &Gt;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ultimos comentarios -->
    <div class="container mx-auto px-4">
        <div class="mt-8">
            <h2 class="text-xl font-bold mb-4">Últimos Comentarios</h2>

            <div class="block rounded-lg bg-light shadow-secondary-1 relative border border-solid border-neutral-300 p-2">

                <table class="min-w-full text-left font-light text-surface dark:text-white">
                    <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                        <tr>
                            <th scope="col" class="px-6 py-4">#</th>
                            <th scope="col" class="px-6 py-4">Usuario</th>
                            <th scope="col" class="px-6 py-4">Comentario</th>
                            <th scope="col" class="px-6 py-4">Fecha</th>
                            <th scope="col" class="px-6 py-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latest_comments as $comment)
                        <tr class="border-b border-neutral-200 dark:border-white/10">
                            <td class="whitespace-nowrap px-6 py-4">
                                {{ $comment->u_id }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                {{ $comment->u_name }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                {{ Str::limit($comment->body,200) }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                {{ $comment->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <a href="{{ route( ($comment->commentable_type == 'App\Models\Product' ? 'product.show' : 'business.show'), [$comment->comment_id]  ).'#comment_id_'.$comment->comment_id  }}" class="text-blue-600 hover:underline">Ver &Gt;</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>

    </div>

    
</x-admin-layout>
