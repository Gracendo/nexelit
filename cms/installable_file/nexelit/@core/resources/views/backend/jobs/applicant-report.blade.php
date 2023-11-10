@extends('backend.admin-master')
@section('site-title')
    {{__('Applicant Report')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
               <x-error-msg/>
                <x-flash-msg/>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Applicant Report")}}</h4>
                        <form action="{{route('admin.jobs.applicant.report')}}" method="get" enctype="multipart/form-data" id="report_generate_form">
                            <input type="hidden" name="page" value="1">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="start_date">{{__('Start Date')}}</label>
                                        <input type="date" name="start_date" value="{{$start_date}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="end_date">{{__('End Date')}}</label>
                                        <input type="date" name="end_date" value="{{$end_date}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="job_id">{{__('Select Job')}}</label>
                                        <select name="job_id" id="job_id" class="form-control nice-select wide">
                                            <option value="">{{__('All')}}</option>
                                            @foreach($jobs as $job)
                                            <option @if( $job->id == $job_id) selected @endif value="{{$job->id}}">{{$job->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="items">{{__('Items')}}</label>
                                        <select name="items" id="items" class="form-control">
                                            <option @if( $items == '10') selected @endif value="10">{{__('10')}}</option>
                                            <option @if( $items == '20') selected @endif value="20">{{__('20')}}</option>
                                            <option @if( $items == '50') selected @endif value="50">{{__('50')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Submit')}}</button>
                                    @if(!empty($order_data) && count($order_data) > 0)
                                    <button type="button" class="btn btn-secondary mt-4 pr-4 pl-4" id="download_as_csv"><i class="fas fa-download"></i> {{__('CSV')}}</button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if(!empty($order_data))
                <div class="card">
                    <div class="card-body">
                        @if(count($order_data) > 0)
                        @php
                            $all_custom_fields_un = unserialize($order_data[0]->form_content,['class' =>false]);
                            unset($all_custom_fields_un['captcha_token']);
                        @endphp
                       <div class="table-wrap">
                           <table class="table table-bordered">
                               <thead>
                                   <th>{{__('Job ID')}}</th>
                                   <th>{{__('Job Title')}}</th>
                                   @foreach($all_custom_fields_un as $key => $field)
                                   <th>{{ucfirst(str_replace('-',' ',$key))}}</th>
                                   @endforeach
                                   <th>{{__('Attachment')}}</th>
                                   <th>{{__('Date')}}</th>
                               </thead>
                               <tbody>
                                   @foreach($order_data as $data)
                                   <tr>
                                       <td>{{$data->jobs_id}}</td>
                                       <td>{{$data->job->title}}</td>
                                       @php
                                           $all_custom_fields_un = unserialize($data->form_content,['class' =>false]);
                                           unset($all_custom_fields_un['captcha_token']);
                                       @endphp
                                       @if($all_custom_fields_un)
                                       @foreach($all_custom_fields_un as $field)
                                        <td>{{$field}}</td>
                                       @endforeach
                                       @endif
                                       @php
                                           $all_custom_fields_un = unserialize($data->attachment);
                                       @endphp
                                       @if($all_custom_fields_un)
                                       @foreach($all_custom_fields_un as $field)
                                           <td><a class="width_20ch" href="{{url('/').$field}}">{{url('/').$field}}</a></td>
                                       @endforeach
                                       @endif
                                       <td>{{date_format($data->created_at,'d M Y')}}</td>
                                   </tr>
                                   @endforeach
                               </tbody>
                           </table>
                       </div>
                        <div class="pagination-wrapper report-pagination">
                            {!! $order_data->links() !!}
                        </div>
                        @else
                            <div class="alert alert-warning">{{__('No Item Found')}}</div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <script>
        $(document).ready(function (){

            $('.nice-select').niceSelect();

           $(document).on('click','.report-pagination nav ul li a',function (e){
              e.preventDefault();
               var el = $(this);
               var href = el.attr('href');
               var match = href.match(/(:?=)\d+/);
               var pageNumber = match != null ? match[0].replace('=',' ') : '';
               $('input[name="page"]').val(pageNumber.trim());
               $('#report_generate_form').submit();
           });

           $(document).on('click','#download_as_csv',function (e){
               e.preventDefault();
               exportTableToCSV('payment-logs-report.csv');
           });

            function downloadCSV(csv, filename) {
                var csvFile;
                var downloadLink;

                // CSV file
                csvFile = new Blob([csv], {type: "text/csv"});

                // Download link
                downloadLink = document.createElement("a");

                // File name
                downloadLink.download = filename;

                // Create a link to the file
                downloadLink.href = window.URL.createObjectURL(csvFile);

                // Hide download link
                downloadLink.style.display = "none";

                // Add the link to DOM
                document.body.appendChild(downloadLink);

                // Click download link
                downloadLink.click();
            }

            function exportTableToCSV(filename) {
                var csv = [];
                var rows = document.querySelectorAll("table tr");

                for (var i = 0; i < rows.length; i++) {
                    var row = [], cols = rows[i].querySelectorAll("td, th");

                    for (var j = 0; j < cols.length; j++)
                        row.push(cols[j].innerText);

                    csv.push(row.join(","));
                }

                // Download CSV file
                downloadCSV(csv.join("\n"), filename);
            }


        });


    </script>
@endsection
