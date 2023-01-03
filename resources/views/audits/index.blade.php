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
                    <table class="table table-striped" >
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Model</th>
                            <th scope="col">Action</th>
                            <th scope="col">User</th>
                            <th scope="col">Time</th>
                            <th scope="col">Old Values</th>
                            <th scope="col">New Values</th>
                          </tr>
                        </thead>
                        <tbody id="audits">
                          @foreach($audits as $audit)
                            <tr>
                              <td>{{ $audit->auditable_type }} (id: {{ $audit->auditable_id }})</td>
                              <td>{{ $audit->event }}</td>
                              <td>{{ $audit->user->name }}</td>
                              <td>{{ $audit->created_at }}</td>
                              <td>
                                <table class="table">
                                  @foreach($audit->old_values as $attribute => $value)
                                    <tr>
                                      <td><b>{{ $attribute }}</b></td>
                                      <td>{{ $value }}</td>
                                    </tr>
                                  @endforeach
                                </table>
                              </td>
                              <td>
                                <table class="table">
                                  @foreach($audit->new_values as $attribute => $value)
                                    <tr>
                                      <td><b>{{ $attribute }}</b></td>
                                      <td>{{ $value }}</td>
                                    </tr>
                                  @endforeach
                                </table>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
