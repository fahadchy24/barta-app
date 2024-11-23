<section
    id="newsfeed"
    class="space-y-6">
    <!-- Barta Card -->
    <article
        class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
        <!-- Barta Card Top -->
        <header>
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <!-- User Avatar -->
                    <div class="flex-shrink-0">
                        <img
                            class="h-10 w-10 rounded-full object-cover"
                            src="{{ asset($post->author->avatar_url) }}"
                            alt="{{ $post->author->full_name }}"/>
                    </div>
                    <!-- /User Avatar -->

                    <!-- User Info -->
                    <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                        <a
                            href="{{ route('user.searchedResult', $post->author->username) }}"
                            class="hover:underline font-semibold line-clamp-1">
                            {{ $post->author->full_name }}
                        </a>

                        <a
                            href="{{ route('user.searchedResult', $post->author->username) }}"
                            class="hover:underline text-sm text-gray-500 line-clamp-1">
                            {{ '@' . $post->author->username }}
                        </a>
                    </div>
                    <!-- /User Info -->
                </div>

                @if(Auth::check() && Auth::id() == $post->author_id)
                    <!-- Card Action Dropdown -->
                    <div
                        class="flex flex-shrink-0 self-center"
                        x-data="{ open: false }">
                        <div class="relative inline-block text-left">
                            <div>
                                <button
                                    @click="open = !open"
                                    type="button"
                                    class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                                    id="menu-0-button">
                                    <span class="sr-only">Open options</span>
                                    <svg
                                        class="h-5 w-5"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        aria-hidden="true">
                                        <path
                                            d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"></path>
                                    </svg>
                                </button>
                            </div>
                            <!-- Dropdown menu -->
                            <div
                                x-show="open"
                                @click.away="open = false"
                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu"
                                aria-orientation="vertical"
                                aria-labelledby="user-menu-button"
                                tabindex="-1">
                                <!-- Edit Button -->
                                <button
                                    @click="openModal = true"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                >
                                    Edit
                                </button>
                                <!-- Edit Modal -->
                                <div x-show="openModal"
                                     class="fixed z-10 inset-0 overflow-y-auto"
                                     aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                    <div
                                        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                        <!-- Background overlay -->
                                        <div x-show="openModal"
                                             class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                        ></div>

                                        <!-- Modal Content -->
                                        <div x-show="openModal"
                                             class="fixed z-10 inset-0 overflow-y-auto"
                                             aria-labelledby="modal-title" role="dialog" aria-modal="true"
                                             @keydown.escape.window="openModal = false">

                                            <div
                                                class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                                <div
                                                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-lg sm:w-full">

                                                    <form action="{{ route('posts.update', $post->id) }}"
                                                          method="POST"
                                                          class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6"
                                                          enctype="multipart/form-data"
                                                          @submit="openModal = false">
                                                        @csrf
                                                        @method('PUT')

                                                        <!-- Modal Header -->
                                                        <div class="bg-white sm:pb-4">
                                                            <h3 class="text-lg leading-6 font-medium text-gray-900"
                                                                id="modal-title">Edit Post</h3>
                                                        </div>

                                                        <!-- Modal Body -->
                                                        <div class="p-2">
                                                        <textarea
                                                            name="message"
                                                            class="block w-full pt-2 text-gray-900 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0"
                                                            rows="4"
                                                        >{{ old('message', $post->message) }}</textarea>
                                                        </div>

                                                        @if($post->picture)
                                                            <img
                                                                src="{{ $post->picture_url }}"
                                                                class="min-h-auto w-full rounded-lg object-contain max-h-64 md:max-h-72"
                                                                alt=""/>
                                                        @endif

                                                        <!-- Modal Footer -->
                                                        <div
                                                            class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                            <button type="submit"
                                                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                                Save
                                                            </button>
                                                            <button @click="openModal = false" type="button"
                                                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                                Cancel
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Button -->
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="block px-4 py-2 text-sm text-red-700 hover:bg-red-100">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Card Action Dropdown -->
                @endif
            </div>
        </header>

        <!-- Content -->
        <div class="py-4 text-gray-700 font-normal">
            @if($post->picture)
                <img
                    src="{{ $post->picture_url }}"
                    class="min-h-auto w-full rounded-lg object-contain max-h-64 md:max-h-72"
                    alt=""/>
            @endif
            <p>
                {!! $post->message !!}
            </p>
        </div>

        <!-- Date Created & View Stat -->
        <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
            <span class="">{{ $post->created_at->diffForHumans() }}</span>
            <span class="">•</span>
            <span>{{ $post->comments()->count() }} {{ str('comment')->plural($post->comments()->count()) }}</span>
            <span class="">•</span>
            <span>450 views</span>
        </div>

        <hr class="my-6"/>

        <!-- Barta Create Comment Form -->
        <form wire:submit.prevent="submit">
            <!-- Create Comment Card Top -->
            <div>
                <div class="flex items-start space-x-3">
                    <!-- User Avatar -->
                    <div class="flex-shrink-0">
                        <img
                            class="h-10 w-10 rounded-full object-cover"
                            src="{{ asset(auth()->user()->avatar_url) }}"
                            alt="{{ asset(auth()->user()->full_name) }}"/>
                    </div>
                    <!-- /User Avatar -->

                    <!-- Auto Resizing Comment Box -->
                    <div class="text-gray-700 font-normal w-full">
                  <textarea
                      wire:model="comment"
                      x-data="{
                          resize () {
                              $el.style.height = '0px';
                              $el.style.height = $el.scrollHeight + 'px'
                          }
                      }"
                      x-init="resize()"
                      @input="resize()"
                      type="text"
                      name="comment"
                      placeholder="Write a comment..."
                      class="flex w-full h-auto min-h-[40px] px-3 py-2 text-sm bg-gray-100 focus:bg-white border border-sm rounded-lg border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-1 focus:ring-offset-0 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50 text-gray-900"></textarea>
                    </div>
                </div>
            </div>

            <!-- Create Comment Card Bottom -->
            <div>
                <!-- Card Bottom Action Buttons -->
                <div class="flex items-center justify-end">
                    <button
                        type="submit"
                        class="mt-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
                        Comment
                    </button>
                </div>
                <!-- /Card Bottom Action Buttons -->
            </div>
            <!-- /Create Comment Card Bottom -->
        </form>
        <!-- /Barta Create Comment Form -->

        <!-- /Barta Card Bottom -->
    </article>
    <!-- /Barta Card -->

    <hr/>

    <div class="flex flex-col space-y-6">
        <h1 class="text-lg font-semibold"> {{ str('Comment')->plural($comment_count)}} ({{ $comment_count }})</h1>

        @forelse($this->comments as $comment)
            <!-- Barta User Comments Container -->
            <article
                class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-2 sm:px-6 min-w-full divide-y">
                <!-- Comment -->
                <div class="py-4">
                    <!-- Barta User Comments Top -->
                    <header>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <!-- User Avatar -->
                                <div class="flex-shrink-0">
                                    <img
                                        class="h-10 w-10 rounded-full object-cover"
                                        src="{{ $comment->user->avatar_url }}"
                                        alt="{{ $comment->user->full_name }}"/>
                                </div>
                                <!-- /User Avatar -->
                                <!-- User Info -->
                                <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                                    <a
                                        href="{{ route('user.searchedResult', $post->author->username) }}"
                                        class="hover:underline font-semibold line-clamp-1">
                                        {{ $comment->user->full_name }}
                                    </a>

                                    <a
                                        href="{{ route('user.searchedResult', $post->author->username) }}"
                                        class="hover:underline text-sm text-gray-500 line-clamp-1">
                                        {{ '@' . $post->author->username }}
                                    </a>
                                </div>
                                <!-- /User Info -->
                            </div>
                        </div>
                    </header>

                    <!-- Content -->
                    <div class="py-4 text-gray-700 font-normal">
                        <p>{{ $comment->comment }}</p>
                    </div>

                    <!-- Date Created -->
                    <div class="flex items-center gap-2 text-gray-500 text-xs">
                        <span class="">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <!-- /Comment -->
            </article>
        @empty
            <div class="text-center text-gray-500">
                <span>No comment found.</span>
            </div>
        @endforelse
        <!-- /Barta User Comments -->

        @if($this->comments->hasMorePages())
            <div
                class="after:h-px my-12 flex items-center before:h-px before:flex-1  before:bg-gray-300 before:content-[''] after:h-px after:flex-1 after:bg-gray-300  after:content-['']">
                <button wire:click="loadMore" wire:loading.attr="disabled"
                        class="flex items-center rounded-full border border-gray-300 bg-secondary-50 px-3 py-2 text-center text-sm font-medium text-gray-900 hover:bg-gray-100 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                         class="mr-1 h-4 w-4">
                        <path fill-rule="evenodd"
                              d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                              clip-rule="evenodd"/>
                    </svg>
                    Show More
                </button>
            </div>
        @endif
    </div>
</section>
