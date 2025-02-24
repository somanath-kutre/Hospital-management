<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
       <ul class="space-y-2 font-medium">
          <li>
             <x-sidebarlink link="{{route('doc.dash')}}" title="Dashboard" :active="request()->routeIs('doc.dash')"  >
                <x-slot name='icon' >
                   <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                      <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                      <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                   </svg>
                </x-slot>
             </x-sidebarlink>
          </li>
          <li>
            <x-sidebarlink link="{{route('doc.prescription')}}" title="Prescriptions" :active="request()->routeIs('doc.prescription')" >
            </x-sidebarlink>
         </li>
         <li>
            <x-sidebarlink link="{{route('doc.casepaper')}}" title="Case Papers" :active="request()->routeIs('doc.casepaper')" >
            </x-sidebarlink>
         </li>
         <li>
            <x-sidebarlink link="{{route('doc.certificate')}}" title="Certificates" :active="request()->routeIs('doc.certificate')" >
            </x-sidebarlink>
         </li>
       </ul>
    </div>
 </aside>