@if($post->post_published == null)
  <button class="button__inverse" type="submit" name="submit_btn" value="draft_btn">下書き保存</button>
  <button class="button" type="submit" name="submit_btn" value="publish_btn">公開<span class="overSP">する</span></button>
@elseif($post->post_status == 'drafted')
  <button class="button__inverse" type="submit" name="submit_btn" value="draft_btn">下書き保存</button>
  <button class="button" type="submit" name="submit_btn" value="modify_btn">更新する</button>
@else
  <button class="button__inverse" type="submit" name="submit_btn" value="draft_btn">下書きにして保存</button>
  <button class="button" type="submit" name="submit_btn" value="modify_btn">更新する</button>
@endif