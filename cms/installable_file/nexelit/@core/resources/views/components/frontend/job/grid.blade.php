<div class="single-job-list-item">
    <span class="job_type"><i class="far fa-clock"></i> {{__(str_replace('_',' ',$job->employment_status))}}</span>
    <a href="{{route('frontend.jobs.single',$job->slug)}}"><h3 class="title">{{$job->title}}</h3></a>
    <span class="company_name"><strong>{{__('Company:')}}</strong> {{$job->company_name}}</span>
    <span class="deadline"><strong>{{__('Deadline:')}}</strong> {{date("d M Y", strtotime($job->deadline))}}</span>
    <ul class="jobs-meta">
        <li><i class="fas fa-briefcase"></i> {{$job->position}}</li>
        <li><i class="fas fa-wallet"></i> {{$job->salary}}</li>
        <li><i class="fas fa-map-marker-alt"></i> {{$job->job_location}}</li>
    </ul>
</div>