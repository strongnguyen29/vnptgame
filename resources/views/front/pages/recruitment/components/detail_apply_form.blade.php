<div class="nopcvnow">
    <h5 class="text-center">{{ __('VNPT GAME') }}</h5>
    <h6>{{ __('Thông tin đăng ký') }}</h6>
    <form class="row g-3" action="{{ route('front.recruitments.apply') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="col-12">
            <label for="hoten" class="form-label">{{ __('Họ tên:') }}</label>
            <input type="text" name="full_name" class="form-control" id="hoten" placeholder="{{ __('Họ và tên') }}" required>
        </div>
        <div class="col-12">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="{{ __('Email') }}" required>
        </div>
        <div class="col-12">
            <label for="phone" class="form-label">{{ __('Điện thoại') }}</label>
            <input type="text" name="phone" class="form-control" id="phone" placeholder="{{ __('Số điện thoại') }}" required>
        </div>
        <div class="col-12">
            <label for="position" class="form-label">{{ __('Vị rí ứng tuyển') }}</label>
            <input type="text" name="position" class="form-control" id="position" placeholder="{{ __('Vị rí ứng tuyển') }}" required>
        </div>
        <div class="col-12">
            <label for="formFile" class="form-label">{{ __('Tệp CV đính kèm') }}</label>
            <input type="file" name="file_cv_upload" class="form-control" id="formFile" accept=".pdf,.doc,.docx" required>
            <span class="tepdk">{{ __('Tệp đính kèm có đuôi .doc, docx, pdf. Đặt tên file CV_vị trí ứng tuyển_Họ tên') }}</span>
        </div>

        <div class="col-12">
            {!! RecaptchaV3::field('recruitment_apply') !!}
        </div>

        <input type="hidden" name="recruitment_id" value="{{ $recruitment->id }}">

        <div class="col-12 d-grid">
            <button type="submit" class="btn btn-send btn-danger">{{ __('Gửi CV') }}</button>
        </div>
    </form>
</div>
