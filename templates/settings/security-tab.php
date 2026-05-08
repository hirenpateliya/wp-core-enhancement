<h2>Security Settings</h2>

<table class="form-table">

	<tr>
		<th scope="row">
			Disable REST API For Guests
		</th>

		<td>

			<label class="wpce-switch">

				<input type="checkbox"
				       name="wpce_security_settings[disable_rest_api]"
				       value="1"
				       <?php checked( wpce_get_security_option( 'disable_rest_api', 0 ) ); ?>>

				<span class="wpce-slider"></span>

			</label>

		</td>
	</tr>

</table>