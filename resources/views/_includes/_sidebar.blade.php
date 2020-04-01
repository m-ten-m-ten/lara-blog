  <div id="sidebar" class="l-show__side">
    {{-- Table of contents --}}
    <div class="m-show-side-section">
      <div class="toc">
        <div class="toc__title">Table of Contents</div>
        <div class="toc__body"></div>
      </div>
    </div>

    <div id="sidebar__fixed">
      {{-- 最新記事 --}}
      <div class="m-show-side-section">
        <h3 class="m-show-side-section-title">最新記事</h3>

        @include('_includes._postList')

      </div>
    </div>
  </div>