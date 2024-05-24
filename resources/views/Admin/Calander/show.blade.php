<div class="modal fade" tabindex="-1" id="opennotice">
    <div class="modal-dialog" style="max-width: 800px; top: 50px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="ms-4">View Notice</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="notice-details">
                <div class="container-fluid">
                    <div class="student-details notice-details">
                        <div class="student-meta-box">
                            <div class="single-meta">
                                <div class="row">
                                    <div class="col-lg-12 col-md-5 mb-10">
                                        <div class="name">
                                            <strong>Title:</strong> <span id="modal-notice-title"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-3">
                                        <div class="message">
                                            <strong>Message:</strong> <span id="modal-notice-message"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-4 mt-10">
                                        <div class="publish-on">
                                            <strong>Publish On:</strong> <span id="modal-publish-on"></span>
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
</div>
{{-- <script>
    $(document).ready(function() {
        $('.view-notice').click(function() {
            var noticeId = $(this).data('notice-id');
            var noticeTitle = $(this).data('notice-title');
            var noticeMessage = $(this).data('notice-message');
            var publishOn = $(this).data('publish-on');

            // Set modal content
            $('#modal-notice-title').text(noticeTitle);
            $('#modal-notice-message').text(noticeMessage);
            $('#modal-publish-on').text(publishOn);

            $('#opennotice').modal('show');
        });
    });
</script> --}}
