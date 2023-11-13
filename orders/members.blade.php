@extends(Theme::path('orders.master'))

@section('title', __('client.members'))

@section('content')
<section class="bg-gray-50 dark:bg-gray-900">
    <div class="mx-auto max-w-screen-xl">
        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-visible">
            <div class="flex flex-col md:flex-row items-center justify-end space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button type="button" data-drawer-target="drawer-invite-member" data-drawer-show="drawer-invite-member" aria-controls="drawer-invite-member" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Invite Member
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">User</th>
                            <th scope="col" class="px-4 py-3">User Role</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3">Last seen</th>
                            <th scope="col" class="px-4 py-3">Created</th>
                            <th scope="col text-right" class="px-4 py-3">
                                <span>Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->members()->get() as $member)
                        <tr class="border-b dark:border-gray-700">
                            <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex items-center">
                                    <div class="relative inline-flex items-center justify-center w-9 h-9 mr-2 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                        <span class="font-medium text-gray-600 dark:text-gray-300">{{ substr($member->email, 0, 2) }}</span>
                                    </div>
                                    <div class="pl-3">
                                        <div class="text-base font-semibold text-sm">{{ $member->user->username ?? null }}</div>
                                        <div class="font-normal text-gray-800 dark:text-gray-300">{{ $member->email }}</div>
                                    </div>
                                </div>
                            </th>
                            <td class="px-4 py-2">
                                <div class="inline-flex items-center @if($member->is_admin) bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300 @else bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-gray-900 dark:text-gray-300 @endif">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"></path>
                                    </svg>
                                    @if($member->is_admin) Administrator @else Member @endif
                                </div>
                            </td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex items-center">
                                    <div class="w-2.5 h-2.5 mr-2 @if($member->status == 'pending') bg-yellow-500 @elseif($member->status == 'active') bg-green-500 @endif rounded-full"></div>
                                    @if($member->status == 'pending') Pending @elseif($member->status == 'active') Active @endif
                                </div>
                            </td>
                            <td class="px-4 py-3">{{ isset($member->user->last_seen_at) ? $member->user->last_seen_at->diffForHumans() : 'n/a' }}</td>
                            <td class="px-4 py-3">{{ $member->created_at->diffForHumans() }}</td>
                            <td class="px-4 py-5 flex items-center justify-end">
                                <button id="member-edit-dropdown-{{$member->id}}-button" data-dropdown-toggle="member-edit-dropdown-{{$member->id}}" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                                <div id="member-edit-dropdown-{{$member->id}}" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="member-edit-dropdown-{{$member->id}}-button">
                                        <li>
                                            <button type="button" data-drawer-target="drawer-update-member-{{$member->id}}" data-drawer-show="drawer-update-member-{{$member->id}}" aria-controls="drawer-update-member-{{$member->id}}" style="width: 100%;text-align: start;"class="py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</button>
                                        </li>
                                    </ul>
                                    <div class="py-1">
                                        <a href="{{ route('service', ['order' => $order, 'page' => 'delete-member', 'member_id' => $member->id]) }}" class="block py-2 px-4 text-sm text-red-600 hover:bg-red-100 dark:hover:bg-red-600 dark:text-red-500 dark:hover:text-white">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                            <!-- update member drawer component -->
                            <div id="drawer-update-member-{{$member->id}}" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-update-member-{{$member->id}}-label">
                                <h5 id="drawer-label" class="inline-flex items-center mb-2 text-base font-semibold text-gray-500 uppercase dark:text-gray-400">
                            <svg class="w-3.5 h-3.5 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                <path d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-2V5a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V9h2a1 1 0 1 0 0-2Z"/>
                            </svg>
                            {{ $member->email }}</h5>
                            
                                <button type="button" data-drawer-hide="drawer-update-member-{{$member->id}}" aria-controls="drawer-update-member-{{$member->id}}" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close menu</span>
                                </button>
                                <form action="{{ route('service', ['page' => 'update-member', 'order' => $order->id, 'member_id' => $member->id]) }}" method="POST" class="mb-6">
                                @csrf
                                <div class="relative mb-6">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                            <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                                            <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                                        </svg>
                                    </div>
                                    <input type="email" disabled class="bg-gray-50 cursor-not-allowed border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input" placeholder="{{ $member->email }}">
                                </div>

                                <div class="mb-6">
                                    <label for="is_admin-{{$member->id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Role</label>
                                    <select id="is_admin-{{$member->id}}" onchange="hidePermissions({{$member->id}})" name="is_admin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="1" @if($member->is_admin) selected @endif>Administrator (All Permissions)</option>
                                    <option value="0" @if(!$member->is_admin) selected @endif>Member (Selected Permissions)</option>
                                    </select>
                                </div>
                            
                                <div class="mb-6 @if($member->is_admin) hidden @endif" id="permissions-{{$member->id}}">
                                    <label for="permissions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permissions</label>
                            
                                    <div style="height: 400px; overflow: scroll; padding: 5px;">
                                        @foreach($order->getService()->permissions()->all() as $key => $permission)
                                        <div class="flex mb-3">
                                            <div class="flex items-center h-5">
                                                <input id="permission-{{$key}}" @if(array_key_exists($key, $member->permissions)) checked="" @endif name="permissions[{{$key}}]" aria-describedby="permission-{{$key}}-text" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            </div>
                                            <div class="ml-2 text-sm">
                                                <label for="permission-{{$key}}" class="font-medium text-gray-900 dark:text-gray-300">{{ str_replace("_", " ", $key) }}</label>
                                                <p id="permission-{{$key}}-text" class="text-xs font-normal text-gray-500 dark:text-gray-300">{{ $permission['description'] }}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                            
                                </div>
                                <button type="submit" class="text-white justify-center flex items-center bg-primary-700 hover:bg-primary-800 w-full focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">{{__('client.update')}}</button>
                                </form>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    Showing
                    <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
                    of
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $order->members()->count() }}</span>
                </span>
            </nav>
        </div>
    </div>
</section>

<!-- invite member drawer component -->
<div id="drawer-invite-member" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-invite-member-label">
   <h5 id="drawer-label" class="inline-flex items-center mb-6 text-base font-semibold text-gray-500 uppercase dark:text-gray-400">
  <svg class="w-3.5 h-3.5 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
    <path d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-2V5a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V9h2a1 1 0 1 0 0-2Z"/>
  </svg>
  Invite Member</h5>
  <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">Invite a team member to come and manage this order. If the user is not registered, they'll be sent an email to register and join the team.</p>

   <button type="button" data-drawer-hide="drawer-invite-member" aria-controls="drawer-invite-member" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
      </svg>
      <span class="sr-only">Close menu</span>
   </button>
   <form action="{{ route('service', ['page' => 'invite-member', 'order' => $order->id]) }}" class="mb-6">
      <div class="relative mb-6">
         <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
            </svg>
         </div>
         <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input" placeholder="john@example.com">
      </div>

      <div class="mb-6">
        <label for="is_admin-0" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Role</label>
        <select id="is_admin-0" onchange="hidePermissions(0)" name="is_admin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option value="1">Administrator (All Permissions)</option>
          <option value="0" selected>Member (Selected Permissions)</option>
        </select>
      </div>

      <div class="mb-6" id="permissions-0">
        <label for="permissions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permissions</label>

        <div style="height: 400px; overflow: scroll; padding: 5px;">
            @foreach($order->getService()->permissions()->all() as $key => $permission)
            <div class="flex mb-3">
                <div class="flex items-center h-5">
                    <input id="permission-{{$key}}" name="permissions[{{$key}}]" aria-describedby="permission-{{$key}}-text" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                </div>
                <div class="ml-2 text-sm">
                    <label for="permission-{{$key}}" class="font-medium text-gray-900 dark:text-gray-300">{{ str_replace("_", " ", $key) }}</label>
                    <p id="permission-{{$key}}-text" class="text-xs font-normal text-gray-500 dark:text-gray-300">{{ $permission['description'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

      </div>
      <button type="submit" class="text-white justify-center flex items-center bg-primary-700 hover:bg-primary-800 w-full focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Send Invite</button>
   </form>
</div>

<script>
    function hidePermissions(id)
    {
        var is_admin = document.getElementById('is_admin-' + id).value;

        console.log(is_admin);

        if(is_admin == '1') {
            document.getElementById('permissions-' + id).classList.add('hidden');
        } else {
            document.getElementById('permissions-' + id).classList.remove('hidden');
        }
    }
</script>
@endsection