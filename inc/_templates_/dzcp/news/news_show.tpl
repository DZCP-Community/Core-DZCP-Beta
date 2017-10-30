<!-- start news_show.tpl -->
<div class="posts posts--cards posts--cards-thumb-left post-list">
	<div class="post-list__item">
		<div class="posts__item posts__item--card posts__item--category-1 card">
			<figure class="posts__thumb">
				<a href="#"><img src="{$kat}" class="newsImage"></a>
			</figure>
			<div class="posts__inner">
				<div class="card__content">
					<div class="posts__cat">
						<span class="label posts__cat-label">{$kat_name}</span>
					</div>
					<h6 class="posts__title">{$sticky} {$intern} {$titel}</h6>
					<time datetime="{$datum}" class="posts__date">{$datum}</time>
					<div style="display:inline-block;height:155px;overflow:hidden !important;text-overflow: ellipsis;" class="posts__excerpt">
                        {$text}
					</div>
				</div>
				<footer class="posts__footer card__footer">
					<div class="post-author">
						<div class="post-author__info">
							<h4 class="post-author__name">{$autor} - {$datum}{lang msgID="uhr"}</h4>
						</div>
					</div>
					<ul class="post__meta meta">
						<li class="meta__item meta__item--views">{$hits}</li>
						<!-- <li class="meta__item meta__item--likes"><a href="#"><i class="meta-like icon-heart"></i> 530</a></li> -->
						<li class="meta__item meta__item--comments"><a href="?action=show&amp;id={$id}">{if $comments >= 2}{$comments} {lang msgID="news_kommentare"}{else}{$comments} {lang msgID="news_kommentar"}{/if}</a></li>
					</ul>
				</footer>
			</div>
		</div>
	</div>
</div>
<!-- end news_show.tpl -->