<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- This is an example component -->
        <div class="min-w-full border rounded" style="height: 65vh;">
            <div class="bg-white">
                <div class="w-full">
                    <div class="flex items-center border-b border-gray-300 pl-3 py-3">
                        <img class="h-10 w-10 rounded-full object-cover"
                        src="https://images.pexels.com/photos/3777931/pexels-photo-3777931.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260"
                        alt="username" />
                        <span class="block ml-2 font-bold text-base text-gray-600">Akacbot</span>
                        <span class="connected text-green-500 ml-2" >
                            <svg width="6" height="6">
                                <circle cx="3" cy="3" r="3" fill="currentColor"></circle>
                            </svg>
                        </span>
                    </div>
                    <div id="chat" class="w-full overflow-y-auto p-10 relative" style="height: 65vh;" ref="toolbarChat">
                        <ul>
                            <li class="clearfix2">
                                <div class="w-full flex justify-end" >
                                    <div class="bg-gray-100 rounded px-5 py-2 my-2 text-gray-700 relative" style="max-width: 300px;">
                                        <span class="block">Hello</span>
                                        <span class="block text-xs text-left">10:32pm</span>
                                    </div>
                                </div>
                                <div class="w-full flex justify-end" >
                                    <div class="bg-gray-100 rounded px-5 py-2 my-2 text-gray-700 relative" style="max-width: 300px;">
                                        <span class="block">how are you?</span>
                                        <span class="block text-xs text-left">10:32pm</span>
                                    </div>
                                </div>
                                <div class="w-full flex justify-start">
                                    <div class="bg-indigo-500 rounded px-5 py-2 my-2 text-gray-50 relative" style="max-width: 300px;">
                                        <span class="block">I am fine</span>
                                        <span class="block text-xs text-right">10:42pm</span>
                                    </div>
                                </div>
                                <div class="w-full flex justify-start">
                                    <div class="bg-indigo-500 rounded px-5 py-2 my-2 text-gray-50 relative" style="max-width: 300px;">
                                        <span class="block">Why you so serious?</span>
                                        <span class="block text-xs text-right">10:42pm</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="w-full py-3 px-3 flex items-center justify-between border-t border-gray-300">
                        <input aria-placeholder="Masukkan pesan disini ..." placeholder="Masukkan pesan disini ..."
                            class="py-2 mx-3 pl-5 block w-full rounded-full bg-gray-100 outline-none focus:text-gray-700" type="text" name="message" required/>

                        <button class="outline-none focus:outline-none" type="submit">
                            <svg class="text-indigo-500 h-7 w-7 origin-center transform rotate-90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
