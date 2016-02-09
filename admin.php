<div class="wrap">
	<h1>Dasheroo KPIs</h1>
	<p>
		Use this plugin to aggregate information about your published posts and pages 
		in order to show KPIs for your team on your
		<a href="https://www.dasheroo.com/" target="_blank">Dasheroo</a> dashboard.
	</p>
	<form method="get" action="<?php echo $formUrl ?>">
		<input type="hidden" name="page" value="dashkpis_settings"/>
		<table class="form-table">
			<tr>
				<th scope="row">Insight label</th>
				<td>
					<input type="text" name="label" value="<?php echo htmlspecialchars($label); ?>"/>
					<p class="description">
						This label will appear as a description for your insight in Dasheroo.
					</p>
				</td>
			</tr>
			<tr>
				<th scope="row">Count content of type</th>
				<td>
					<select name="type">
						<?php
							$options=array(
								"post"=>"Posts",
								"page"=>"Pages",
								"attachment"=>"Uploaded media",
								"any"=>"All content"
							);
						?>
						<?php foreach ($options as $key=>$value) { ?>
							<option value="<?php echo $key; ?>"
									<?php if ($key==$type) echo "selected"; ?>
							>
								<?php echo $value; ?>
							</option>
						<?php } ?>
					</select>
					<p class="description">
						What kind of content do you want to count?
					</p>
				</td>
			</tr>
			<tr>
				<th scope="row">State</th>
				<td>
					<select name="state">
						<?php
							$options=array(
								"publish"=>"Published content",
								"private"=>"Privately published content",
								"draft"=>"Drafts",
								"any"=>"Published content and drafts"
							);
						?>
						<?php foreach ($options as $key=>$value) { ?>
							<option value="<?php echo $key; ?>"
									<?php if ($key==$state) echo "selected"; ?>
							>
								<?php echo $value; ?>
							</option>
						<?php } ?>
					</select>
					<p class="description">
						Filter the count to content that is published or in a draft state.
					</p>
				</td>
			</tr>
			<tr>
				<th scope="row">Recently published</th>
				<td>
					<input type="text" name="publishedWithinDays" value="<?php echo htmlspecialchars($publishedWithinDays); ?>"/>
					<p class="description">
						Count only content that has a publication date within this many days.<br/>
						Should be a number, e.g 7.
					</p>
				</td>
			</tr>
			<tr>
				<th scope="row">Recently updated</th>
				<td>
					<input type="text" name="updatedWithinDays" value="<?php echo htmlspecialchars($updatedWithinDays); ?>"/>
					<p class="description">
						Count only content that was updated within this many days.<br/>
						Should be a number, e.g 7.
					</p>
				</td>
			</tr>
		</table>
		<p class="submit">
			<input type="submit" name="submit" value="Get url" class="button button-primary"/>
		</p>
		<?php if ($showData) { ?>
			<h2>Url</h2>
			<p>Use the following url to configure your dasheroo custom insight:</p>
			<div class="dashkpis-data">
				<?php echo $url; ?>
			</div>
			<h2>Data</h2>
			<p>The url currently returns the following data:</p>
			<div class="dashkpis-data"><pre><?php echo $data; ?></pre></div>
		<?php } ?>
	</form>
</div>