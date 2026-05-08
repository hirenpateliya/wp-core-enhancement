<h2>General Settings</h2>

<table class="form-table">

	<tr>
		<th scope="row">
			Disable Gutenberg
		</th>

		<td>
			<label class="wpce-switch">

				<input type="checkbox"
				       name="wpce_general_settings[disable_gutenberg]"
				       value="1"
				       <?php checked( wpce_get_general_option( 'disable_gutenberg', 0 ) ); ?>>

				<span class="wpce-slider"></span>

			</label>
		</td>
	</tr>

	<tr>
		<th scope="row">
			Enable SVG Upload
		</th>

		<td>
			<label class="wpce-switch">

				<input type="checkbox"
				       name="wpce_general_settings[enable_svg_upload]"
				       value="1"
				       <?php checked( wpce_get_general_option( 'enable_svg_upload', 0 ) ); ?>>

				<span class="wpce-slider"></span>

			</label>
		</td>
	</tr>

	<tr>
		<th scope="row">
			Enable Duplicate Post
		</th>

		<td>
			<label class="wpce-switch">

				<input type="checkbox"
				       name="wpce_general_settings[enable_duplicate_post]"
				       value="1"
				       <?php checked( wpce_get_general_option( 'enable_duplicate_post', 0 ) ); ?>>

				<span class="wpce-slider"></span>

			</label>
		</td>
	</tr>

</table>