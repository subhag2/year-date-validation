 <?php
  $current_year= date("Y");
  $start_year = $current_year - 19;
?>
<div class="row Tenure-section">
    <div class="col-lg-2">
        <div class="dash-input-wrapper mb-30 md-mb-10">
            <label for="">Tenure*</label>
        </div>
    </div>
    <div class="col-lg-10">
        <div class="row">
            <div class="col-sm-3">
                <div class="dash-input-wrapper mb-30">
                    <select id="fromYear" class="fromYear country-city-select" name="employment_from_year[]">
                    <?php
                        $lcurrent_year=$current_year-1;
                        foreach (range($lcurrent_year, $start_year) as $year) {
                      echo "<option value=\"$year\">$year</option>";
                    }?>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="dash-input-wrapper mb-30">
                    <select id="fromMonth" class="fromMonth country-city-select" name="employment_from_month[]">
                    <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May" selected>May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="dash-input-wrapper mb-30">
                    <select id="toYear" class="toYear country-city-select" name="employment_to_year[]">
                        <?php foreach (range($current_year, $start_year) as $year) {
                        echo "<option value=\"$year\">$year</option>";
                        }?>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="dash-input-wrapper mb-30">
                    <select id="toMonth" class="toMonth country-city-select" name="employment_to_month[]">
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
			$(document).ready(function() {
				const monthOrder = {
					"January": 1,
					"February": 2,
					"March": 3,
					"April": 4,
					"May": 5,
					"June": 6,
					"July": 7,
					"August": 8,
					"September": 9,
					"October": 10,
					"November": 11,
					"December": 12
				};

				$(document).on('change', '.fromYear', function() {
					var row = $(this).closest('.row');
					var fromYear = $(this).val();
					var toYearSelect = row.find('.toYear');
					
					// Update toYear options based on fromYear
					toYearSelect.find('option').each(function() {
						if ($(this).val() < fromYear) {
							$(this).hide();
						} else {
							$(this).show();
						}
					});

					// Ensure the selected toYear is valid
					if (toYearSelect.val() < fromYear) {
						toYearSelect.val(fromYear);
					}

					// Trigger change on fromMonth to re-evaluate toMonth options
					row.find('.fromMonth').trigger('change');
				});

				$(document).on('change', '.fromMonth', function() {
					var row = $(this).closest('.row');
					var fromMonth = $(this).val();
					var fromYear = row.find('.fromYear').val();
					var toYear = row.find('.toYear').val();
					var toMonthSelect = row.find('.toMonth');

					// If fromYear equals toYear, restrict toMonth options
					if (fromYear === toYear) {
						toMonthSelect.find('option').each(function() {
							if (monthOrder[$(this).val()] < monthOrder[fromMonth]) {
								$(this).hide();
							} else {
								$(this).show();
							}
						});

						// Ensure the selected toMonth is valid
						if (monthOrder[toMonthSelect.val()] < monthOrder[fromMonth]) {
							toMonthSelect.val(fromMonth);
						}
					} else {
						// If fromYear is different from toYear, show all months
						toMonthSelect.find('option').show();
					}
				});

				$(document).on('change', '.toYear', function() {
					var row = $(this).closest('.row');
					var fromYear = row.find('.fromYear').val();
					var toYear = $(this).val();

					if (toYear < fromYear) {
						alert('You cannot select a "to year" lower than the "from year".');
						$(this).val(fromYear);
					} else if (fromYear === toYear) {
						// Trigger fromMonth change to handle toMonth restriction
						row.find('.fromMonth').trigger('change');
					} else {
						// Show all months in toMonth if toYear is different
						row.find('.toMonth option').show();
					}
				});
			});
		</script>
