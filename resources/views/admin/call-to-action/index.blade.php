@extends('layouts.admin')
@section('title','Call to Action')
@section('content')
<div class="container">
    <div class="page-inner">
       <div class="row">
          <div class="col-md-12">
             <div class="card card-round">
                <div class="card-header project-details-card-header">
                   <div class="d-flex align-items-center">
                      <h4 class="project-details-card-header-title"><i class='bx bxl-telegram bx-tada' ></i>Call to Action</h4>
                   </div>
                </div>

                <div class="card-body">
                   <div class="table-responsive">
                      <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                         <div class="row">
                            <div class="col-sm-12">
                               <table id="add-row" class="display table table-striped table-hover basic-datatables" role="grid" aria-describedby="add-row_info">
                                  <thead class="">
                                     <tr role="row">
                                        <th>Sl</th>
                                        <th>Title</th>
                                        <th>Sub Title</th>
                                        <th>Button</th>
                                        <th>Call Button</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                     <tr role="row" class="odd">
                                        <td class="sorting_1">01</td>
                                        <td>{{ $action->title }}</td>
                                        <td>{{ $action->sub_title }}</td>
                                        <td>
                                            <div style="font-size: 20px; font-weight: bold; ">
                                                <a href="{{$action->button_url}}">{{$action->button_text}}</a>
                                            </div>

                                            @if($action->main_icon)
                                            <div style="margin-top: 15px;">
                                                <img src="{{ asset('storage/' . $action->main_icon) }}"
                                                    width="60" height="60" alt="icon"
                                                    style="border-radius: 8px;">
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div style="font-size: 20px; font-weight: bold; ">
                                                <a href="{{$action->call_button_url}}">{{$action->call_button_text}}</a>

                                            </div>
                                            Contact No: {{$action->contact_no}}
                                            @if($action->call_button_icon)
                                            <div style="margin-top: 15px;">
                                                <img src="{{ asset('storage/' . $action->call_button_icon) }}"
                                                    width="60" height="60" alt="icon"
                                                    style="border-radius: 8px;">
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($action->status)
                                            <a href="{{ route('action.toggle-status', $action->id) }}"
                                                class="badge badge-success">Active</a>
                                            @else
                                            <a href="{{ route('action.toggle-status', $action->id) }}"
                                                class="badge badge-danger">Inactive</a>
                                            @endif
                                        </td>
                                        <td>
                                           <div class="form-button-action">
                                            <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#edit_action_{{ $action->id }}"
                                            title="edit" class="btn btn-link btn-success btn-lg">
                                            <i class='bx bxs-edit'></i>

                                           </div>
                                        </td>
                                        <!--edit action modal-->
                                        @include('admin.call-to-action.edit-modal')
                                        <!--edit action modal-->
                                     </tr>
                                  </tbody>
                               </table>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection
