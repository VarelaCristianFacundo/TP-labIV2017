import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AltaproductosComponent } from './altaproductos.component';

describe('AltaproductosComponent', () => {
  let component: AltaproductosComponent;
  let fixture: ComponentFixture<AltaproductosComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AltaproductosComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AltaproductosComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
