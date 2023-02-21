@extends('admin.layout.default')
@section('title')
        Help & Support
@endsection
@section('contents')
    <!-- Title -->
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">Help & Support</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ URL::to('admin/dashboard') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home"
                                    width="20" height="20" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="var(--bs-secondary)" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item ">Help & Support</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <input class="form-control list-search mw-300px float-end mb-5" type="search" placeholder="Search">
                <table class="table table-nowrap mb-0" data-list='{"valueNames": ["id", "name", "manager", "status"]}'>
                    <thead class=" thead-light">
                        <tr>
                            <th class="w-80px">
                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="id">
                                    ID
                                </a>
                            </th>
                            <th>
                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="Name">
                                    Name
                                </a>
                            </th>
                            <th>
                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="Platform">
                                    Platform
                                </a>
                            </th>
                            <th>
                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="Email">
                                    Email
                                </a>
                            </th>
                            <th>
                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="Subject">
                                    Subject
                                </a>
                            </th>
                            <th>
                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="Message">
                                    Message
                                </a>
                            </th>
                            <th>
                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="Actions">
                                    Actions
                                </a>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="list">
                        <tr>
                            <td>01</td>
                            <td>Kelly Doyle</td>
                            <td>Mobile</td>
                            <td> wiegand@hotmail.com</td>
                            <td>Lorem Ipsum..</td>
                            <td>Lorem Ipsum is simply dummy text..</td>
                            <td><span class="badge rounded-pill cursor-pointer text-bg-info fa-solid fa-reply" data-bs-target="#mymodal" data-bs-toggle="modal">Reply</span>
                            </td>
                        </tr>
                        <tr>
                            <td>02</td>
                            <td>Kelly Doyle</td>
                            <td>Web</td>
                            <td> wiegand@hotmail.com</td>
                            <td>Lorem Ipsum..</td>
                            <td>Lorem Ipsum is simply dummy text..</td>
                            <td><span class="badge rounded-pill cursor-pointer text-bg-info fa-solid fa-reply" data-bs-target="#mymodal" data-bs-toggle="modal">Reply</span>
                            </td>
                        </tr>
                        <tr>
                            <td>03</td>
                            <td>Kelly Doyle</td>
                            <td>Web</td>
                            <td> wiegand@hotmail.com</td>
                            <td>Lorem Ipsum..</td>
                            <td>Lorem Ipsum is simply dummy text..</td>
                            <td><span class="badge rounded-pill cursor-pointer text-bg-info fa-solid fa-reply" data-bs-target="#mymodal" data-bs-toggle="modal">Reply</span>
                            </td>
                        </tr>
                        <tr>
                            <td>04</td>
                            <td>Kelly Doyle</td>
                            <td>Mobile</td>
                            <td>wiegand@hotmail.com</td>
                            <td>Lorem Ipsum..</td>
                            <td>Lorem Ipsum is simply dummy text..</td>
                            <td><span class="badge rounded-pill cursor-pointer text-bg-info fa-solid fa-reply"data-bs-target="#mymodal" data-bs-toggle="modal">Reply</span>
                            </td>
                        </tr>
                    </tbody>
                    <div class="modal" id="mymodal">
                        <div class="modal-dialog modal-dialog-centered">
                             <div class="modal-content">
                                 <div class="d-block p-3">
                                    <h6 class="mb-5">New Message</h6>
                                    <form>
                                        <div class="mb-3">
                                          <input type="text" class="form-control" id="recipient-name" placeholder="Wiegend@hotmail.com">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="recipient-name" placeholder="Subject">
                                        </div>
                                      </form>
                                    <div class="modal-body p-0">
                                       <textarea  rows="5" class="form-control" placeholder="Lorem Ipsum is simply dummy text.." ></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                       <button type="button" class="btn btn-primary">Replay</button>
                                    </div>
                                 </div>

                             </div>
                        </div>
                   </div>
                </table>
            </div>
        </div>
    </div>
@endsection

