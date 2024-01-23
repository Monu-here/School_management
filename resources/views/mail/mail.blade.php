<style>
    .marksheet-content {
        display: flex;
        justify-content: space-around;
    }

    .mm {
        text-align: center;
    }

    .school-smae {
        text-align: center;
        align-items: center;
    }

    .acc-s {
        text-align: center;
        padding: 20px 0px 10px 0px;
    }

    .student-name {
        margin-left: 100px;
    }
</style>
<div class="container">
    <div class="marksheet-content">
        <div class="imga">
            <img src="https://png.pngtree.com/png-vector/20230415/ourmid/pngtree-school-logo-design-template-vector-png-image_6705854.png"
                alt="" width="100">
        </div>
        <div class="headername">
            <h5>Your School Name</h5>
            <div class="school-smae">
                <small>Your Affiliated</small>
                <br>
                <small>Your Address</small>
                <br>
                <small>Your phone and email</small>
            </div>
        </div>

        <span>Date : {{ $date }}</span>
    </div>
    <div class="acc-s">
        <h4>Academic Session / Exam Name: 000/00/00</h4>
        <span><strong>Subject:</strong>  Important: Your Child's Academic Results and Marksheet
        </span>
    </div>
    <div class="mail-body">
        Dear {{ $student->parent_email }},
        <br>
        I hope this email finds you well. I'm pleased to share {{ $student->name }}'s excellent academic results:
        {{ $student->name }} has shown commendable dedication and effort throughout the academic term, and we are
        thrilled
        to report that their overall performance has been outstanding.
        <br><br>
        Below, you will find a summary of the marks and
        grades achieved in each subject:
        <br>
        <h2>Marks</h2>

        <p>Total Marks: {{ $totalMarks }}</p>
        <p>Percentage: {{ $percentage }}%</p>
        <p>Grade: {{ $student->grade }}</p>
        <p>Remark: {{ $student->remark }}</p>
        <br>
        <a href="{{ route('admin.mark.admin.mark.download', ['studentId' => $student->id]) }}"
            class="btn btn-primary">Download
            Marksheet</a>
        <br>
        By clicking on the button, you will be directed to a secure portal where you can view and download the official
        marksheet. If you encounter any issues or have any questions regarding the results, please do not hesitate to
        reach out to us.
        <br><br>
        Congratulations on your child's achievements! Feel free to reach out with any questions. Thank you for
        entrusting us with your child's education.


        <br>
        Best,
        <br>
        <strong>{{ config('app.name') }}</strong>
    </div>
