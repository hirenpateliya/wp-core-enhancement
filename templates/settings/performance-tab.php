<h2>Performance Settings</h2>

<table class="form-table">

	<tr>
		<th scope="row">
			Disable WordPress Emojis
		</th>

		<td>

			<label class="wpce-switch">

				<input type="checkbox"
				       name="wpce_performance_settings[disable_emojis]"
				       value="1"
				       <?php checked( wpce_get_performance_option( 'disable_emojis', 0 ) ); ?>>

				<span class="wpce-slider"></span>

			</label>

		</td>
	</tr>
	<tr>
	<th scope="row">
		Disable WordPress Image Duplicates
	</th>

	<td>

		<label class="wpce-switch">

			<input type="checkbox"
			       name="wpce_performance_settings[disable_image_duplicates]"
			       value="1"
			       <?php checked( wpce_get_performance_option( 'disable_image_duplicates', 0 ) ); ?>>

			<span class="wpce-slider"></span>

		</label>

	</td>
</tr>
<tr>
	<th scope="row">
		Minify CSS
	</th>

	<td>

		<label class="wpce-switch">

			<input type="checkbox"
			       name="wpce_performance_settings[enable_css_minify]"
			       value="1"
			       <?php checked( wpce_get_performance_option( 'enable_css_minify', 0 ) ); ?>>

			<span class="wpce-slider"></span>

		</label>

	</td>
</tr>
<tr>
	<th scope="row">
		Minify JavaScript
	</th>

	<td>

		<label class="wpce-switch">

			<input type="checkbox"
			       name="wpce_performance_settings[enable_js_minify]"
			       value="1"
			       <?php checked( wpce_get_performance_option( 'enable_js_minify', 0 ) ); ?>>

			<span class="wpce-slider"></span>

		</label>

	</td>
</tr>

</table>