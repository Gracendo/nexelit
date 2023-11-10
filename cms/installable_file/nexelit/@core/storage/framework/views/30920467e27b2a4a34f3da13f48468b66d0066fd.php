<div class="single-job-list-item">
    <span class="job_type"><i class="far fa-clock"></i> <?php echo e(__(str_replace('_',' ',$job->employment_status))); ?></span>
    <a href="<?php echo e(route('frontend.jobs.single',$job->slug)); ?>"><h3 class="title"><?php echo e($job->title); ?></h3></a>
    <span class="company_name"><strong><?php echo e(__('Company:')); ?></strong> <?php echo e($job->company_name); ?></span>
    <span class="deadline"><strong><?php echo e(__('Deadline:')); ?></strong> <?php echo e(date("d M Y", strtotime($job->deadline))); ?></span>
    <ul class="jobs-meta">
        <li><i class="fas fa-briefcase"></i> <?php echo e($job->position); ?></li>
        <li><i class="fas fa-wallet"></i> <?php echo e($job->salary); ?></li>
        <li><i class="fas fa-map-marker-alt"></i> <?php echo e($job->job_location); ?></li>
    </ul>
</div><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/components/frontend/job/grid.blade.php ENDPATH**/ ?>