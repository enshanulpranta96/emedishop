@extends('layouts.master')
@section('title')
Create Users
@endsection
@section('content')


<div class="row justify-content-center">
    <div class="col-8 customCard p-5">
        <h4 class="form-text text-center">Create New Support Request</h4>
        <hr>
        <form method="POST" action="{{route('ticket.create')}}">
            @csrf
            <div class="row justify-content-center mx-auto">
                <div class="col-md-6 mb-3">
                    <label for="text" class="form-label">Name</label>
                    <span class="text-danger"></span><br />
                    <input type="text" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{Auth::user()->name}}" name="name" placeholder="Type your username..." readonly="readonly">
                    @error('name')
                        <p class="text-danger mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="text" class="form-label">Email</label>
                    <input type="email" type="text" class="form-control @error('email') is-invalid @enderror" id="email" value="{{Auth::user()->email}}" name="email" placeholder="Type your email..." readonly="readonly">
                    @error('email')
                        <p class="text-danger mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label for="text" class="form-label">Subject</label>
                    <input type="text" type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="I'm having this issue...">
                    @error('subject')
                        <p class="text-danger mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="text" class="form-label">Department</label>
                    <select class="form-control mb-3" id="department" name="department">
                        <option value="" selected="">Select One</option>
                        <option value="SALES">SALES</option>
                        <option value="MARKETING">MARKETING</option>
                        <option value="DEVELOPER">DEVELOPER</option>
                    </select>
                    @error('department')
                        <p class="text-danger mt-1">{{$message}}</p>
                    @enderror
                </div>

<div class="col-md-4 mb-3">
    <label for="text" class="form-label">Related Service</label>
    <select class="form-control mb-3" id="related_service" name="related_service">
        <option value="" selected="">Select One</option>
        <option value="Server Self Managed"> <small> Server Self Managed</small></option>
        <option value="Virtual Server Self Managed">Virtual Server Self Managed</option>
        <option value="Fully Managed Server By Bfin">Fully Managed Server By Bfin</option>
        <option value="Fully Managed Virtual Server">Fully Managed Virtual Server</option>
        <option value="Shared Web Hosting">Shared Web Hosting</option>
        <option value="Wordsxtra">Wordsxtra</option>
        <option value="Notesxtra">Notesxtra</option>
        <option value="Worksheet">Worksheet</option>
        <option value="Payroll">Payroll</option>
        <option value="Hr Payroll">Hr Payroll</option>
        <option value="Accounting">Accounting</option>
        <option value="Email">Email</option>
        <option value="Login Issue">Login Issue</option>
        <option value="Lost Password">Lost Password</option>
    </select>
    @error('related_service')
        <p class="text-danger mt-1">{{$message}}</p>
    @enderror
</div>

                <div class="col-md-4 mb-3">
                    <label for="text" class="form-label">Priority</label>
                    <select class="form-control mb-3" id="priority" name="priority">
                        <option value="" selected="">Select One</option>
                        <option value="LOW">LOW</option>
                        <option value="MEDIUM">MEDIUM</option>
                        <option value="HIGH">HIGH</option>
                    </select>
                    @error('priority')
                        <p class="text-danger mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label for="text" class="form-label">Message</label>
                    <span class="text-danger"></span><br />

                    <textarea class="form-control" name="message" id="message" rows="7"  @error('message') is-invalid @enderror placeholder="I have this this issues..."></textarea>
                    @error('message')
                        <p class="text-danger mt-1">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="w-100 customCard py-2">Submit Ticket</button>
            </div>
        </form>
    </div>
</div>

@endsection

