<script>
import HistoricalCard from './HistoricalCard.vue';

export default {
    extends: HistoricalCard,

    methods: {
        fillCard(data){
            if (data == null) {
                this.title = 'No Data';
                this.value = 'No Data';
                this.unit = 'No Data';
                this.badge.value = 'No data';
                this.badge.backgroundColor = 'bg-grey-050';
                this.badge.textColor = 'text-grey-600';
            }else{
                this.title = data.title;
                this.value = parseFloat(Math.round(data.value * 100) / 100).toFixed(2);
                this.unit = data.unit;
                this.badge.value = parseFloat(Math.round(data.badgeValue * 100) / 100).toFixed(2) + ' %';
                if (data.badgeValue < 0) {
                    this.badge.backgroundColor = 'bg-red-lightest';
                    this.badge.textColor = 'text-red-dark';
                }else if(data.badgeValue > 0){
                    this.badge.backgroundColor = 'bg-cyan-100';
                    this.badge.textColor = 'text-cyan-800';
                    this.badge.value = '+ ' + this.badge.value;
                }
            };
        },
    }
}
</script>