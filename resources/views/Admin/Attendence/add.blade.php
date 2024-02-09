<div class="container">
    <div class="card">
        <div class="card-header header-elements-inline">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if ($students)
                    @foreach ($students as $student)
                        <form method="POST" action="{{ route('admin.atten.mark', ['studentId' => $student->id]) }}">
                            @csrf
                            <input type="hidden" name="class_id" value="{{ $student->class_id }}">
                            <input type="hidden" name="section_id" value="{{ $student->section_id }}">
                            <input type="radio" id="present" name="attendance_type" value="P">
                            <label for="present">Present</label><br>

                            <input type="radio" id="absent" name="attendance_type" value="A">
                            <label for="absent">Absent</label><br>

                            <input type="radio" id="leave" name="attendance_type" value="L">
                            <label for="leave">Leave</label><br>

                            <input type="text" name="notes" placeholder="Notes">
                            <button type="submit">Submit</button>

                            <h5 class="card-title font-weight-bold">Student Attendence</h5>
                            <img src="{{ asset($student->image) }}" alt="" srcset="" width="50">
                            {{ $student->name }}
                            @php
                                $sectionName = $sections
                                    ->where('id', $student->section_id)
                                    ->pluck('name')
                                    ->first();
                            @endphp
                            {{ $student->classes->name }}
                            ({{ $sectionName }})
                        </form>
                    @endforeach

                @endif
            </div>
        </div>
    </div>
</div>
