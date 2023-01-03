<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table">
                        @forelse ($audits as $audit)
                        <tr>
                            <td>
                                @lang('product.updated.metadata', $audit->getMetadata())

                                @foreach ($audit->getModified() as $attribute => $modified)
                                    <ul>
                                        <li>@lang('product.' . $audit->event . '.modified.' . $attribute, $modified)</li>
                                    </ul>
                                @endforeach
                                </td>
                        </tr>

                        @empty
                            <tr>@lang('product.unavailable_audits')</tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
